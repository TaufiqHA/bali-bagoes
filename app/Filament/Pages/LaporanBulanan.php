<?php

namespace App\Filament\Pages;

use Carbon\Carbon;
use App\Models\Invoice;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;

class LaporanBulanan extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.laporan-bulanan';

    protected static ?string $navigationGroup = 'Laporan';

    protected static ?int $navigationSort = 1;

    public $tahun;

    public function mount(): void
    {
        $this->form->fill([
            'tahun' => now()->year,
        ]);
        $this->tahun = now()->year;
    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('tahun')
                ->label('Pilih Tahun')
                ->options(
                    collect(range(now()->year - 5, now()->year + 1))
                        ->mapWithKeys(fn ($y) => [$y => $y])
                )
                ->reactive()
                ->afterStateUpdated(fn ($state) => $this->tahun = $state),
        ];
    }

    public function getLaporan(): Collection
    {
        $data = collect();
        for ($i = 1; $i <= 12; $i++) {
            $partner = Invoice::whereYear('created_at', $this->tahun)
                ->whereMonth('created_at', $i)
                ->where('status', 'sukses')
                ->with('product') // pastikan eager loading
                ->get()
                ->sum(fn($invoice) => $invoice->product->fee_partner ?? 0);

            $office = Invoice::whereYear('created_at', $this->tahun)
                ->whereMonth('created_at', $i)
                ->where('status', 'sukses')
                ->with('product')
                ->get()
                ->sum(fn($invoice) => $invoice->product->fee_sell ?? 0);
            
            $data->push([
                'bulan' => Carbon::create()->month($i)->locale('id')->translatedFormat('F'),
                'partner' => $partner,
                'office' => $office,
            ]);
        }

        return $data;
    }

    public function exportPdf()
    {
        $data = $this->getLaporan();

        $pdf = Pdf::loadView('exports.laporan-bulanan', [
            'tahun' => $this->tahun,
            'data' => $data,
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, "Laporan-Bulanan-{$this->tahun}.pdf");
    }

}
