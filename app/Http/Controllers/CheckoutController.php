<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PaymentGatewaySetting;
use GuzzleHttp\Client;
use App\Models\Invoice;
use App\Models\Products;
use Xendit\Configuration;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use App\Settings\PaymentSettings;
use Illuminate\Support\Facades\Auth;
use App\Services\Payments\GatewayResolver;

class CheckoutController extends Controller
{
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

        $product = Products::findOrFail($productId);
        $gateway = PaymentGatewaySetting::where('is_set', true)->first()->gateway_name;
        // $gateway = app(PaymentSettings::class)->gateway;

        $orderId = 'ORDER-' . time() . '-' . Str::random(10);

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

        $gatewayService = GatewayResolver::resolve($gateway);
        return $gatewayService->process($request, $product, $invoice);
    }

    protected function generateInvoiceNumber(): string
    {
        $prefix = 'INV'; // Awalan tetap
        $length = 8; // Panjang total (INV + 5 karakter acak = 8)
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // Huruf dan angka (hindari karakter ambigu)

        do {
            $randomString = '';
            for ($i = 0; $i < $length - strlen($prefix); $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            $invoiceNumber = $prefix . $randomString; // Contoh: INVA3B7X9
        } while (Invoice::where('invoice', $invoiceNumber)->exists()); // Cek unik

        return $invoiceNumber;
    }
}
