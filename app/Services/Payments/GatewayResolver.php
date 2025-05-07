<?php

namespace App\Services\Payments;

class GatewayResolver
{
    public static function resolve(string $gateway): PaymentGatewayInterface
    {
        return match ($gateway) {
            'midtrans' => new MidtransGateway(),
            'xendit' => new XenditGateway(),
            'doku' => new DokuGateway(),
            default => throw new \Exception("Unsupported gateway: {$gateway}"),
        };
    }
}
