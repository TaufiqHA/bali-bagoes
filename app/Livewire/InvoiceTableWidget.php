<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\PaymentGatewaySetting;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class InvoiceTableWidget extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public array $stats = [];

    public function mount(): void
    {
        $this->loadStats();
    }
    public function updatedTableFilters(): void
    {
        $this->loadStats();
    }

    public function loadStats(): void
    {
        $query = Invoice::with('product')->where('status', 'sukses');

        $filters = $this->tableFilters;

        if (!empty($filters['status']['value'])) {
            $query->where('status', $filters['status']['value']);
        }

        if (!empty($filters['payment_gateway']['value'])) {
            $query->where('payment_gateway', $filters['payment_gateway']['value']);
        }

        if (!empty($filters['created_at']['from'] ?? null)) {
            $query->whereDate('created_at', '>=', Carbon::parse($filters['created_at']['from']));
        }
        
        if (!empty($filters['created_at']['to'] ?? null)) {
            $query->whereDate('created_at', '<=', Carbon::parse($filters['created_at']['to']));
        }

        $filtered = $query->get();

        $this->stats = [
            'office' => $filtered->sum(fn($invoice) => $invoice->product->fee_sell ?? 0),
            'partner' => $filtered->sum(fn($invoice) => $invoice->product->fee_partner ?? 0),
            'sukses' => $filtered->where('status', 'sukses')->count(),
            'gagal' => $filtered->where('status', 'gagal')->count(),
        ];
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(Invoice::with('product')->latest())
            ->columns([
                TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y'),

                TextColumn::make('invoice')
                    ->label('Invoice'),

                TextColumn::make('product.price')
                    ->label('Transaksi')
                    ->money('IDR'),

                TextColumn::make('product.fee_sell')
                    ->label('Pendapatan Office')
                    ->money('IDR'),

                TextColumn::make('product.fee_partner')
                    ->label('Pendapatan Partner')
                    ->money('IDR'),

                TextColumn::make('payment_gateway')
                    ->label('Payment Gateway'),

                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'sukses',
                        'danger' => 'gagal',
                        'warning' => 'pending',
                    ])
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'sukses' => 'Sukses',
                        'gagal' => 'Gagal',
                        'pending' => 'Pending',
                    ]),

                SelectFilter::make('payment_gateway')
                    ->label('Payment Gateway')
                    ->options(
                        PaymentGatewaySetting::all()->pluck('gateway_name', 'gateway_name')
                    ),

                Filter::make('created_at')
                    ->label('Rentang Tanggal')
                    ->form([
                        DatePicker::make('from')->label('Dari Tanggal'),
                        DatePicker::make('to')->label('Sampai Tanggal'),
                    ])
                    ->columnSpan(2)
                    ->columns(2)
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['from'],
                                fn ($query, $from) => $query->whereDate('created_at', '>=', Carbon::parse($from)))
                            ->when(
                                $data['to'],
                                fn ($query, $to) => $query->whereDate('created_at', '<=', Carbon::parse($to))
                            );
                    })
            ], layout: \Filament\Tables\Enums\FiltersLayout::AboveContent);
    }


    public function render()
    {
        return view('livewire.invoice-table-widget');
    }
}
