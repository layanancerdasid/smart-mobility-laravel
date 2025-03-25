<div>
    {{-- Stop trying to control. --}}
    <livewire:filter-periode />
    <div class="text-center mb-4 mt-4">
        <h4 class="fw-bold text-white py-2 rounded" style="background-color: #21294A">Jumlah Total Kendaraan</h4>
    </div>
    <livewire:perbandingan-kendaraan wire:poll.60s />
    <livewire:traffic-chart wire:poll.60s />
    <div class="text-center mb-4 mt-4">
        <h4 class="fw-bold text-white py-2 rounded" style="background-color: #21294A">Jumlah Total Kendaraan</h4>
    </div>
    <livewire:cctv-stream />

</div>
