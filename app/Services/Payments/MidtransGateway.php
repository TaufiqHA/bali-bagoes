<?php

namespace App\Services\Payments;

use Log;
use App\Models\Invoice;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\PaymentGatewaySetting;
use App\Services\Payments\PaymentGatewayInterface;

class MidtransGateway implements PaymentGatewayInterface
{
    public function process(Request $request, Products $product, Invoice $invoice): mixed
    {
        // Get Midtrans settings from database
        $midtransSettings = PaymentGatewaySetting::forGateway('Midtrans');
        
        if (!$midtransSettings || !$midtransSettings->is_active) {
            throw new \Exception('Midtrans payment gateway is not configured or inactive');
        }

        // Configure Midtrans with database values
        \Midtrans\Config::$isProduction = !$midtransSettings->use_sandbox;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Set the appropriate keys based on environment
        if ($midtransSettings->use_sandbox) {
            \Midtrans\Config::$serverKey = $midtransSettings->sandbox_server_key;
            \Midtrans\Config::$clientKey = $midtransSettings->sandbox_client_key;
        } else {
            \Midtrans\Config::$serverKey = $midtransSettings->production_server_key;
            \Midtrans\Config::$clientKey = $midtransSettings->production_client_key;
        }

        $params = [
            'transaction_details' => [
                'order_id' => $invoice->invoice,
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
    }
}