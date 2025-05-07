<?php

namespace App\Services\Payments;

use App\Models\Invoice;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentGatewaySetting;
use App\Services\Payments\PaymentGatewayInterface;

class DuitkuGateway implements PaymentGatewayInterface
{
    public function process(Request $request, Products $product, Invoice $invoice): mixed
    {
        // Get Duitku settings from database
        $duitkuSettings = PaymentGatewaySetting::forGateway('Duitku');
        $merchantOrderId = time() . ''; // dari merchant, unik
        
        if (!$duitkuSettings || !$duitkuSettings->is_active) {
            throw new \Exception('Duitku payment gateway is not configured or inactive');
        }

        // Set the appropriate keys based on environment
        $merchantCode = $duitkuSettings->use_sandbox 
            ? $duitkuSettings->sandbox_merchant_key 
            : $duitkuSettings->production_merchant_key;
            
        $apiKey = $duitkuSettings->use_sandbox
            ? $duitkuSettings->sandbox_api_key
            : $duitkuSettings->production_api_key;

        $baseUrl = $duitkuSettings->use_sandbox
            ? 'https://sandbox.duitku.com'
            : 'https://passport.duitku.com';

            $paymentAmount = $product->price;
            $signature = md5($merchantCode . $merchantOrderId . $paymentAmount . $apiKey);

            $customerDetail = [
                'firstName' => $request->name,
                'email' => $request->email,
                'billingAddress' => [
                    'firstName' => $request->name,
                    'countryCode' => 'ID'
                ],
                'shippingAddress' => [
                    'firstName' => $request->name,
                    'countryCode' => 'ID'
                ]
            ];

            $params = [
                'merchantCode' => $merchantCode,
                'paymentAmount' => $paymentAmount,
                'paymentMethod' => $request->payment_method ?? 'VC', // Default to credit card
                'merchantOrderId' => $merchantOrderId,
                'productDetails' => $product->name,
                'customerVaName' => $request->name,
                'email' => $request->email,
                'itemDetails' => [
                    [
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => 1
                    ]
                ],
                'customerDetail' => $customerDetail,
                'callbackUrl' => route('callback.terima', ['id' => $invoice->id]),
                'signature' => $signature,
                'expiryPeriod' => 60 // 60 minutes
            ];

            $url = $baseUrl . '/webapi/api/merchant/v2/inquiry';
            $params_string = json_encode($params);

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $params_string,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($params_string)
                ],
                CURLOPT_SSL_VERIFYPEER => false
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode == 200) {
                $result = json_decode($response, true);
                if (isset($result['paymentUrl'])) {
                    return redirect($result['paymentUrl']);
                }
                throw new \Exception('Invalid response from Duitku API');
            }

            throw new \Exception('Duitku API error: ' . ($response ?: "HTTP Code $httpCode"));
    }
}