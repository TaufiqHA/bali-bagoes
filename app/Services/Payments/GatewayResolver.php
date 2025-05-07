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
            'Midtrans' => new MidtransGateway(),
            'Xendit' => new XenditGateway(),
            'Doku' => new DokuGateway(),
            'Duitku' => new DuitkuGateway(),
            'Tripay' => new TripayGateway(),
            default => throw new \Exception("Unsupported gateway: {$gateway}"),
        };
    }
}
