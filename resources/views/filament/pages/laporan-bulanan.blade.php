<x-filament-panels::page>
    <form wire:submit.prevent="exportPdf" class="flex items-center justify-between mb-4">
        {{ $this->form }}

        <x-filament::button type="submit">
            Export PDF
        </x-filament::button>
    </form>

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-center border border-collapse border-gray-400">
            <thead class="bg-yellow-400 text-black">
                <tr>
                    <th class="border border-gray-400 px-2 py-1">No</th>
                    <th class="border border-gray-400 px-2 py-1">Bulan</th>
                    <th class="border border-gray-400 px-2 py-1">Partner</th>
                    <th class="border border-gray-400 px-2 py-1">Office</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($this->getLaporan() as $index => $row)
                    <tr class="bg-blue-100">
                        <td class="border border-gray-400 px-2 py-1">{{ $index + 1 }}</td>
                        <td class="border border-gray-400 px-2 py-1 capitalize">{{ $row['bulan'] }}</td>
                        <td class="border border-gray-400 px-2 py-1">Rp {{ number_format($row['partner'], 0, ',', '.') }}</td>
                        <td class="border border-gray-400 px-2 py-1">Rp {{ number_format($row['office'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-filament-panels::page>
