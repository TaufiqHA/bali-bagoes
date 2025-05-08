<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PageSettings extends Settings
{
    public string $brand;
    public string $heading;
    public string $description;
    public string $whatsapp;


    public static function group(): string
    {
        return 'page';         // grouping di tabel settings
    }
}
