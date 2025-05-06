<?php

namespace App\Filament\Pages;

use Closure;
use ZipArchive;
use Carbon\Carbon;
use Filament\Forms;
use App\Models\Invoice;
use Filament\Forms\Set;
use App\Models\Products;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\RawJs;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\URL;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Pelmered\FilamentMoneyField\Forms\Components\MoneyInput;

class GenerateInvoice extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.generate-invoice';
    protected static ?string $navigationGroup = 'Invoice Management';
    protected static ?string $navigationLabel = 'Manual Invoice';
    protected static ?int $navigationSort = 1;

    public $product_id;
    public $jumlah_duplikat = 1;
    public $jatuh_tempo;
    public $payment_gateway;
    public $transaksi;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')
                    ->label('Pilih Produk')
                    ->options(Products::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $product = Products::find($state);
                        $set('transaksi', $product?->price ?? null);
                    }),

                MoneyInput::make('transaksi')
                    ->label('Harga Produk')
                    ->disabled()
                    ->decimals(0)
                    ->prefix('Rp'),
                    
                TextInput::make('jumlah_duplikat')
                    ->label('Jumlah Duplikat')
                    ->numeric()
                    ->minValue(1)
                    ->default(1)
                    ->required(),

                DatePicker::make('jatuh_tempo')
                    ->required()
                    ->native(false)
                    ->displayFormat('d/m/Y'),

                Select::make('payment_gateway')
                    ->required()
                    ->options([
                        'doku' => 'Doku',
                        'midtrans' => 'Midtrans',
                        'xendit' => 'Xendit',
                    ]),
            ])
            ->statePath('data');
    }

    public $data = [];

    public function submit()
    {
        $quantity = $this->data['jumlah_duplikat'] ?? 1;
        $createdRecords = collect();
        $product = Products::find($this->data['product_id']);

        $data = [
            'product_id' => $this->data['product_id'],
            'transaksi' => $product->price,
            'office' => $product->fee_sell,
            'partner' => $product->fee_partner,
            'jatuh_tempo' => $this->data['jatuh_tempo'],
            'payment_gateway' => $this->data['payment_gateway'],
        ];

        $txtContent = "";

        for ($i = 0; $i < $quantity; $i++) {
            $recordData = $data;
            $recordData['invoice'] = $this->generateInvoiceNumber();

            $expirationDate = Carbon::parse($this->data['jatuh_tempo']);
            $signedLink = URL::temporarySignedRoute(
                'invoices.show',
                $expirationDate,
                ['invoice' => $recordData['invoice']]
            );

            $recordData['signed_link'] = $signedLink;
            $recordData['link_expires_at'] = $expirationDate;

            $createdRecords->push(Invoice::create($recordData));

            $txtContent .= $signedLink . "\n\n";
        }

        $filename = 'invoice_links_' . now()->format('Ymd_His') . '.txt';
        Storage::disk('local')->put('invoices/' . $filename, $txtContent);

        return response()->streamDownload(function () use ($txtContent) {
            echo $txtContent;
        }, $filename, [
            'Content-Type' => 'text/plain',
        ]);
    }

    protected function generateInvoiceNumber(): string
    {
        $prefix = 'INVFR';
        $latest = Invoice::where('invoice', 'like', $prefix.'%')
                    ->orderBy('invoice', 'desc')
                    ->first();

        $nextNumber = $latest ? ((int) str_replace($prefix, '', $latest->invoice) + 1) : 1;

        return $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }
}
