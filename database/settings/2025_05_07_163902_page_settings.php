<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('page.brand', 'Ebook Master');
        $this->migrator->add('page.heading', 'Tingkatkan Keterampilan Anda dengan Produk Digital Premium');
        $this->migrator->add('page.description', 'Koleksi ebook dan software terbaik untuk membantu Anda berkembang dalam karir dan bisnis digital.');
    }
};
