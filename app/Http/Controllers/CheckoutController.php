<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Products;
use Xendit\Configuration;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use App\Settings\PaymentSettings;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class CheckoutController extends Controller
{
    private $xenditInvoiceApi;

    public function __construct()
    {
        Configuration::setXenditKey(config('services.xendit.secret_key'));
        $this->xenditInvoiceApi = new InvoiceApi();
    }
    public function showCheckoutForm($productId)
    {
        $product = Products::findOrFail($productId);

        return view('checkout', compact('product'));
    }

    public function processCheckout(Request $request, $productId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $product = Products::findOrFail($productId);

        $orderId = 'ORDER-' . time() . '-' . Str::random(10);

        $gateway = app(PaymentSettings::class)->gateway;

        $transaction = Transaction::create([
            'order_id' => $orderId,
            'product_id' => $product->id,
            'gross_amount' => $product->price,
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'gateway' => $gateway,
        ]);

        $invoice = Invoice::create([
            'invoice' => $this->generateInvoiceNumber(),
            'product_id' => $product->id,
            'transaksi' => $product->price,
            'office' => $product->fee_sell,
            'partner' => $product->fee_partner,
            'jatuh_tempo' => now()->addDay()->format('Y-m-d H:i:s'),
            'payment_gateway' => $gateway,
        ]);

        if($gateway == 'midtrans') {
            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $product->price,
                ],
                'item_details' => [
                    [
                        'id' => $product->id,
                        'price' => $product->price,
                        'quantity' => 1,
                        'name' => $product->name,
                    ]
                ],
                'customer_details' => [
                    'first_name' => $request->name,
                    'email' => $request->email,
                ],
            ];
    
            $snapToken = \Midtrans\Snap::getSnapToken($params);
    
            return view('checkout_payment', compact('snapToken', 'invoice'));
        } else if($gateway == 'xendit') {
            $externalId = 'order-' . Str::uuid();

            $order = Order::create([
                'user_id' => $request->name . Str::random(),
                'external_id' => $externalId,
                'amount' => $product->price,
                'status' => 'PENDING',
            ]);
    
            $params = [
                'external_id' => $externalId,
                'amount' => $product->price,
                'description' => 'Pembayaran Order #' . $product->id,
                'invoice_duration' => 3600,
                'currency' => 'IDR',
                'customer' => [
                    'given_names' => $request->name,
                    'email' => $request->email,
                ],
                'success_redirect_url' => route('callback.terima', ['id' => $invoice->id]),
            ];
    
            $invoice = $this->xenditInvoiceApi->createInvoice($params);
    
            $order->update([
                'invoice_id' => $invoice['id'],
            ]);
    
            return redirect($invoice['invoice_url']);
        } else if($gateway == 'doku') {
            $client = new Client();

            $clientId = env('DOKU_CLIENT_ID');
            $secretKey = env('DOKU_SECRET_KEY');
            $requestId = Str::uuid()->toString();
            $timestamp = now()->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');
            $requestTarget = '/checkout/v1/payment'; // HARUS PERSIS seperti endpoint path

            $body = [
                'order' => [
                    'amount' => 20000,
                    'invoice_number' => 'INV-' . now()->format('YmdHis'),
                    "callback_url" => route('callback.terima', ['id' => $invoice->id]),
                ],
                'payment' => [
                    'payment_due_date' => 60,
                ],
                "customer" => [
                    "name" => $request->name,
                    "email" => $request->email,
                ],
              
            ];

            $jsonBody = json_encode($body);
            $digest = base64_encode(hash('sha256', $jsonBody, true));

            $signatureComponent = <<<EOD
            Client-Id:$clientId
            Request-Id:$requestId
            Request-Timestamp:$timestamp
            Request-Target:$requestTarget
            Digest:$digest
            EOD;            
            
            $signature = base64_encode(hash_hmac('sha256', $signatureComponent, $secretKey, true));

            $headers = [
                'Content-Type' => 'application/json',
                'Client-Id' => $clientId,
                'Request-Id' => $requestId,
                'Request-Timestamp' => $timestamp,
                'Signature' => 'HMACSHA256=' . $signature,
                'Digest' => $digest,
            ];            

            $response = $client->post('https://api-sandbox.doku.com/checkout/v1/payment', [
                'headers' => $headers,
                'body' => $jsonBody,
            ]);

            $responseBody = json_decode($response->getBody(), true);

            return redirect($responseBody['response']['payment']['url']);
        }

        
    }

    protected function generateInvoiceNumber(): string
    {
        $prefix = 'INVFR';
        $latest = Invoice::where('invoice', 'like', $prefix.'%')
                    ->orderBy('invoice', 'desc')
                    ->first();
        
        if ($latest) {
            $lastNumber = (int) str_replace($prefix, '', $latest->invoice);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }
        
        return $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }
}
