<?php

namespace App\Services\Payments;

use App\Models\Invoice;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Services\Payments\PaymentGatewayInterface;

class MidtransGateway implements PaymentGatewayInterface
{
   public function process(Request $request, Products $product, Invoice $invoice): mixed
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

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
