<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PaymentSettings extends Settings
{
    public string $gateway;        // nama gateway yang dipilih

    public static function group(): string
    {
        return 'payment';         // grouping di tabel settings
    }
}
