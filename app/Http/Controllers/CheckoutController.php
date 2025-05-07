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
        $gateway = app(PaymentSettings::class)->gateway;

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
