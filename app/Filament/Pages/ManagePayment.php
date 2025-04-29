<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use App\Settings\PaymentSettings;
use Filament\Forms\Components\Select;

class ManagePayment extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = PaymentSettings::class;

    protected static ?string $navigationGroup = 'Settiings';

    protected static ?int $navigationSort = 1;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('gateway')
                    ->label('Pilih Payment Gateway')
                    ->options([
                        'stripe'    => 'Stripe',
                        'midtrans'  => 'Midtrans',
                        'ipaymu'    => 'iPayMu',
                        // …tambahkan sesuai kebutuhan
                    ])
                    ->required(),

            ]);
    }
}
