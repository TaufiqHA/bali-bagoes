<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class InvoiceOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $sukses = Invoice::with('product')->where('status', 'sukses')->get();

        // Hitung total pendapatan office & partner dari transaksi sukses
        $pendapatanOffice = $sukses->sum(fn($invoice) => $invoice->product->fee_sell ?? 0);
        $pendapatanPartner = $sukses->sum(fn($invoice) => $invoice->product->fee_partner ?? 0);

        // Hitung transaksi gagal
        $transaksiGagal = Invoice::where('status', 'gagal')->count();

        return [
            Card::make('Pendapatan Office', 'Rp ' . number_format($pendapatanOffice, 0, ',', '.'))
                ->description('Dari transaksi sukses')
                ->descriptionIcon('heroicon-m-building-office'),

            Card::make('Pendapatan Partner', 'Rp ' . number_format($pendapatanPartner, 0, ',', '.'))
                ->description('Dari transaksi sukses')
                ->descriptionIcon('heroicon-m-user-group'),

            Card::make('Transaksi Sukses', $sukses->count())
                ->description('Jumlah transaksi sukses')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Card::make('Transaksi Gagal', $transaksiGagal)
                ->description('Jumlah transaksi gagal')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}
