<?php

namespace App\Http\Controllers;

use App\Models\Order;
use GuzzleHttp\Client;
use App\Models\Invoice;
use App\Models\Products;
use Xendit\Configuration;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Xendit\Invoice\InvoiceApi;
use App\Settings\PaymentSettings;
use App\Models\PaymentGatewaySetting;
use App\Services\Payments\GatewayResolver;

class InvoiceController extends Controller
{
    public function show($invoice_id) // $invoice_id hanya angka (contoh: 1234)
    {
        // Gabungkan dengan prefix "INV" untuk cek database
        $invoice = Invoice::where('invoice', 'INV' . $invoice_id)->firstOrFail();

        // Cek kadaluarsa (opsional, jika pakai database-based expiry)
        if (isset($invoice->jatuh_tempo) && now()->gt($invoice->jatuh_tempo)) {
            abort(404, "Link sudah kadaluarsa");
        }

        return view('invoices.show', compact('invoice'));
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

        $invoice = Invoice::find($request->invoice_id);

        $transaction = Transaction::create([
            'order_id' => $orderId,
            'product_id' => $product->id,
            'gross_amount' => $product->price,
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'gateway' => $gateway,
        ]);

        $gatewayService = GatewayResolver::resolve($gateway);
        return $gatewayService->process($request, $product, $invoice);
        
    }

}
