<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Products;
use Filament\Forms;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Filament\Notifications\Notification;

class GenerateInvoice extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.generate-invoice';
    protected static ?string $navigationGroup = 'Invoice Management';
    protected static ?string $navigationLabel = 'Generate Invoice';
    protected static ?int $navigationSort = 1;

    public $product_id;
    public $jumlah_duplikat = 1;
    public $harga;

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('product_id')
                ->label('Pilih Produk')
                ->options(Products::all()->pluck('name', 'id'))
                ->searchable()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    $product = Products::find($state);
                    $set('harga', $product?->price);
                })
                ->required(),

            Forms\Components\TextInput::make('harga')
                ->label('Harga')
                ->disabled()
                ->dehydrated(false),

            Forms\Components\TextInput::make('jumlah_duplikat')
                ->label('Jumlah Duplikat')
                ->numeric()
                ->minValue(1)
                ->default(1)
                ->required(),
        ];
    }

    public function submit()
    {
        $product = Products::find($this->product_id);

        if (!$product) {
            Notification::make()
                ->title('Produk tidak ditemukan')
                ->danger()
                ->send();

            return;
        }

        $files = [];

        for ($i = 1; $i <= $this->jumlah_duplikat; $i++) {
            $pdf = Pdf::loadView('pdf.invoice', [
                'product' => $product,
                'no' => $i,
            ]);

            $fileName = 'invoice_' . now()->timestamp . "_$i.pdf";
            $path = storage_path('app/invoices/' . $fileName);

            // Pastikan folder ada
            if (!file_exists(dirname($path))) {
                mkdir(dirname($path), 0777, true);
            }

            file_put_contents($path, $pdf->output());

            $files[] = $path;
        }

        if (count($files) == 1) {
            return response()->download($files[0])->deleteFileAfterSend();
        } else {
            $zipFileName = 'invoices_' . now()->timestamp . '.zip';
            $zipPath = storage_path('app/invoices/' . $zipFileName);
            $zip = new ZipArchive();

            $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

            foreach ($files as $file) {
                $zip->addFile($file, basename($file));
            }
            $zip->close();

            // Hapus file PDF setelah dijadikan zip
            foreach ($files as $file) {
                unlink($file);
            }

            return response()->download($zipPath)->deleteFileAfterSend();
        }
    }

}
