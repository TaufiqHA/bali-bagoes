<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Xendit\Configuration;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use App\Settings\PaymentSettings;
use Illuminate\Support\Facades\Auth;

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
    
            return view('checkout_payment', compact('snapToken'));
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
                'success_redirect_url' => route('callback.terima'),
            ];
    
            $invoice = $this->xenditInvoiceApi->createInvoice($params);
    
            $order->update([
                'invoice_id' => $invoice['id'],
            ]);
    
            return redirect($invoice['invoice_url']);
        }

        
    }
}
