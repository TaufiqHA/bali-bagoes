<?php

namespace App\Filament\Pages;

use ZipArchive;
use Carbon\Carbon;
use Filament\Forms;
use App\Models\Invoice;
use Filament\Forms\Set;
use App\Models\Products;
use Filament\Pages\Page;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\URL;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;

class GenerateInvoice extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.generate-invoice';
    protected static ?string $navigationGroup = 'Invoice Management';
    protected static ?string $navigationLabel = 'Manual Invoice';
    protected static ?int $navigationSort = 1;

    public $product_id;
    public $jumlah_duplikat = 1;
    public $jatuh_tempo;
    public $payment_gateway;
    public $harga;

    protected function getFormSchema(): array
    {
        return [
            Select::make('product_id')
                ->label('Pilih Produk')
                ->options(Products::all()->pluck('name', 'id')) // Menggunakan relationship
                ->searchable()
                ->live() // Gunakan live() sebagai pengganti reactive()
                ->afterStateUpdated(function ($state, Set $set) {
                    $product = Products::find($state);
                    $set('transaksi', $product?->price ?? '0');
                })
                ->required(),

            // TextInput::make('transaksi')
            //     ->label('Harga Produk')
            //     ->disabled()
            //     ->dehydrated(),

            TextInput::make('jumlah_duplikat')
                ->label('Jumlah Duplikat')
                ->numeric()
                ->minValue(1)
                ->default(1)
                ->required(),
                
            // TextInput::make('office')
            //     ->required()
            //     ->disabled()
            //     ->maxLength(255),
                
            // TextInput::make('partner')
            //     ->required()
            //     ->disabled()
            //     ->maxLength(255),
                
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
        ];
    }

    public function submit()
    {
        
        $quantity = $this->jumlah_duplikat ?? 1;
        $createdRecords = collect();
        $product = Products::find($this->product_id);

        $data = [
            'product_id' => $this->product_id,
            'transaksi' => $product->price,
            'office' => $product->fee_sell,
            'partner' => $product->fee_partner,
            'jatuh_tempo' => $this->jatuh_tempo,
            'payment_gateway' => $this->payment_gateway,
        ];

        // Buat konten TXT
        $txtContent = "Daftar Link Invoice yang Digenerate\n";
        $txtContent .= "Tanggal: " . now()->format('Y-m-d H:i:s') . "\n";
        $txtContent .= "Jumlah Invoice: " . $quantity . "\n\n";

        for ($i = 0; $i < $quantity; $i++) {
            $recordData = $data;
            $recordData['invoice'] = $this->generateInvoiceNumber();
            
            $expirationDate = Carbon::parse($this->jatuh_tempo);
            $signedLink = URL::temporarySignedRoute(
                'invoices.show',
                $expirationDate,
                ['invoice' => $recordData['invoice']]
            );
            
            $recordData['signed_link'] = $signedLink;
            $recordData['link_expires_at'] = $expirationDate;
            
            $createdRecords->push(Invoice::create($recordData));
            
            // Tambahkan ke konten TXT
            $txtContent .= "Invoice #" . ($i+1) . ":\n";
            $txtContent .= "Nomor Invoice: " . $recordData['invoice'] . "\n";
            $txtContent .= "Link: " . $signedLink . "\n";
            $txtContent .= "Berlaku hingga: " . $expirationDate->format('Y-m-d H:i:s') . "\n\n";
        }

        // Simpan ke file TXT
        $filename = 'invoice_links_' . now()->format('Ymd_His') . '.txt';
        Storage::disk('local')->put('invoices/' . $filename, $txtContent);

        // Return response dengan link download
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
        
        if ($latest) {
            $lastNumber = (int) str_replace($prefix, '', $latest->invoice);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }
        
        return $prefix . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }


}
