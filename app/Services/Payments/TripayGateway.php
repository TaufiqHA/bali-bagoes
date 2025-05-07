<?php

namespace App\Services\Payments;

use App\Models\Invoice;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\PaymentGatewaySetting;
use App\Services\Payments\PaymentGatewayInterface;

class TripayGateway implements PaymentGatewayInterface
{
    public function process(Request $request, Products $product, Invoice $invoice): mixed
    {
        // Get Tripay settings from database
        $tripaySettings = PaymentGatewaySetting::forGateway('Tripay');
        
        if (!$tripaySettings || !$tripaySettings->is_active) {
            throw new \Exception('Tripay payment gateway is not configured or inactive');
        }

        // Set the appropriate keys based on environment
        $apiKey = $tripaySettings->use_sandbox 
            ? $tripaySettings->sandbox_api_key 
            : $tripaySettings->production_api_key;
            
        $privateKey = $tripaySettings->use_sandbox
            ? $tripaySettings->sandbox_secret_key
            : $tripaySettings->production_secret_key;

        $merchantCode = $tripaySettings->use_sandbox
            ? $tripaySettings->sandbox_merchant_key
            : $tripaySettings->production_merchant_key;

        $baseUrl = $tripaySettings->use_sandbox
            ? 'https://tripay.co.id/api-sandbox'
            : 'https://tripay.co.id/api';

        $amount = $product->price;
        $merchantRef = $invoice->invoice;
        $signature = hash_hmac('sha256', $merchantCode.$merchantRef.$amount, $privateKey);

        $data = [
            'method'         => $request->payment_method ?? 'BRIVA', // Default to BRIVA
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $request->name,
            'customer_email' => $request->email,
            'order_items'    => [
                [
                    'sku'         => $product->sku ?? 'PROD-'.$product->id,
                    'name'        => $product->name,
                    'price'       => $product->price,
                    'quantity'    => 1,
                ]
            ],
            'return_url' => route('callback.terima', ['id' => $invoice->id]),
            'expired_time' => time() + (24 * 60 * 60), // 24 jam
            'signature'    => $signature
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => $baseUrl.'/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER    => ['Authorization: Bearer '.$apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($error) {
            throw new \Exception('CURL Error: '.$error);
        }

        $result = json_decode($response, true);
        
        if ($httpCode !== 200 || !isset($result['data']['checkout_url'])) {
            $errorMsg = $result['message'] ?? 'Invalid response from Tripay API';
            throw new \Exception($errorMsg);
        }

        return redirect($result['data']['checkout_url']);
    }
}