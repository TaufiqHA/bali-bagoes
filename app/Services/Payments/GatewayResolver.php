<?php

namespace App\Services\Payments;

use App\Services\Payments\DokuGateway;
use App\Services\Payments\XenditGateway;
use App\Services\Payments\MidtransGateway;

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
