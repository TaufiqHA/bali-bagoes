<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use Filament\Tables;
use App\Models\Invoice;
use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class InvoiceTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full'; // agar tabel full-width

    public function table(Table $table): Table
    {
        return $table
            ->query(Invoice::with('product')->latest())
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y'),

                Tables\Columns\TextColumn::make('invoice')
                    ->label('Invoice'),

                Tables\Columns\TextColumn::make('product.price')
                    ->label('Transaksi')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('product.fee_sell')
                    ->label('Pendapatan Office')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('product.fee_partner')
                    ->label('Pendapatan Partner')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('payment_gateway')
                    ->label('Payment Gateway'),

                Tables\Columns\BadgeColumn::make('status')
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
                        Invoice::query()->distinct()->pluck('payment_gateway', 'payment_gateway')->toArray()
                    ),

                    Filter::make('created_at')
                        ->label('Tanggal')
                        ->form([
                            DatePicker::make('date')->label('Tanggal'),
                        ])
                        ->query(function (Builder $query, array $data) {
                            return $query->when(
                                $data['date'],
                                fn ($q, $date) => $q->whereDate('created_at', Carbon::parse($date))
                            );
                        }),        
                    ],layout: FiltersLayout::AboveContent);
    }
}
