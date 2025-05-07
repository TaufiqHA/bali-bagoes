<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Widget as BaseWidget;
use Illuminate\Database\Eloquent\Collection;

class InvoiceOverview extends BaseWidget
{
    protected static string $view = 'filament.widgets.invoice-dashboard-widget';

    protected static ?int $sort = 0;
    protected int|string|array $columnSpan = 'full';

    public function getStats(): array
    {
        $sukses = Invoice::with('product')->where('status', 'sukses')->get();

        $pendapatanOffice = $sukses->sum(fn($invoice) => $invoice->product->fee_sell ?? 0);
        $pendapatanPartner = $sukses->sum(fn($invoice) => $invoice->product->fee_partner ?? 0);
        $transaksiGagal = Invoice::where('status', 'gagal')->count();

        return [
            [
                'label' => 'Pendapatan Office',
                'value' => 'Rp ' . number_format($pendapatanOffice, 0, ',', '.'),
                'icon' => 'heroicon-m-building-office',
            ],
            [
                'label' => 'Pendapatan Partner',
                'value' => 'Rp ' . number_format($pendapatanPartner, 0, ',', '.'),
                'icon' => 'heroicon-m-user-group',
            ],
            [
                'label' => 'Transaksi Sukses',
                'value' => $sukses->count(),
                'icon' => 'heroicon-m-check-badge',
                'color' => 'text-success-600',
            ],
            [
                'label' => 'Transaksi Gagal',
                'value' => $transaksiGagal,
                'icon' => 'heroicon-m-x-circle',
                'color' => 'text-danger-600',
            ],
        ];
    }

    public function getInvoices(): Collection
    {
        return Invoice::with('product')->latest()->take(10)->get(); // 10 terakhir
    }
}
