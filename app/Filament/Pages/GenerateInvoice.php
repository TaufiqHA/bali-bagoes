<?php

namespace App\Filament\Pages;

use Closure;
use ZipArchive;
use Carbon\Carbon;
use Filament\Forms;
use App\Models\Invoice;
use App\Models\PaymentGatewaySetting;
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
                    ->options(PaymentGatewaySetting::all()->pluck('gateway_name', 'gateway_name')),
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
            $invoiceNumber = $this->generateRandomInvoiceNumber(); // Contoh: INVAB123
            $recordData['invoice'] = $invoiceNumber;
    
            // Simpan ke database
            $invoice = Invoice::create($recordData);
            $createdRecords->push($invoice);
    
            // Generate URL pendek (tanpa signed)
            $plainUrl = url("/invoices/" . substr($invoiceNumber, 3)); // Hapus "INV" => AB123
            $txtContent .= $plainUrl . "\n\n";
        }    

        $filename = 'invoice_links_' . now()->format('Ymd_His') . '.txt';
        Storage::disk('local')->put('invoices/' . $filename, $txtContent);

        return response()->streamDownload(function () use ($txtContent) {
            echo $txtContent;
        }, $filename, [
            'Content-Type' => 'text/plain',
        ]);
    }
    protected function generateRandomInvoiceNumber(): string
    {
        $prefix = 'INV'; // Awalan tetap
        $length = 8; // Panjang total (INV + 5 karakter acak = 8)
        $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789'; // Huruf dan angka (hindari karakter ambigu)

        do {
            $randomString = '';
            for ($i = 0; $i < $length - strlen($prefix); $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            $invoiceNumber = $prefix . $randomString; // Contoh: INVA3B7X9
        } while (Invoice::where('invoice', $invoiceNumber)->exists()); // Cek unik

        return $invoiceNumber;
    }
}
