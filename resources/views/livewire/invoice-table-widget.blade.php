<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-filament::card>
            <div class="text-sm text-gray-500">Pendapatan Office</div>
            <div class="text-lg font-bold text-gray-800">Rp {{ number_format($stats['office'] ?? 0, 0, ',', '.') }}</div>
        </x-filament::card>

        <x-filament::card>
            <div class="text-sm text-gray-500">Pendapatan Partner</div>
            <div class="text-lg font-bold text-gray-800">Rp {{ number_format($stats['partner'] ?? 0, 0, ',', '.') }}</div>
        </x-filament::card>

        <x-filament::card>
            <div class="text-sm text-gray-500">Transaksi Sukses</div>
            <div class="text-lg font-bold text-success-600">{{ $stats['sukses'] ?? 0 }}</div>
        </x-filament::card>

        <x-filament::card>
            <div class="text-sm text-gray-500">Transaksi Gagal</div>
            <div class="text-lg font-bold text-danger-600">{{ $stats['gagal'] ?? 0 }}</div>
        </x-filament::card>
    </div>
    
    {{ $this->table }}
</div>