<?php

namespace App\Services\Payments;

use GuzzleHttp\Client;
use App\Models\Invoice;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\Payments\PaymentGatewayInterface;

class DokuGateway implements PaymentGatewayInterface
{
    public function process(Request $request, Products $product, Invoice $invoice): mixed
    {
        $client = new Client();

        $clientId = env('DOKU_CLIENT_ID');
        $secretKey = env('DOKU_SECRET_KEY');
        $requestId = Str::uuid()->toString();
        $timestamp = now()->setTimezone('UTC')->format('Y-m-d\TH:i:s\Z');
        $requestTarget = '/checkout/v1/payment';

        $body = [
            'order' => [
                'amount' => $product->price,
                'invoice_number' => $invoice->invoice,
                'callback_url' => route('callback.terima', ['id' => $invoice->id]),
            ],
            'payment' => ['payment_due_date' => 60],
            'customer' => ['name' => $request->name, 'email' => $request->email],
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
