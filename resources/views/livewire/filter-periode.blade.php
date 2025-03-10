<div class="d-flex gap-2">
    <button 
        class="btn btn-light fw-bold {{ $selectedFilter === 'hari' ? 'active' : '' }}" 
        wire:click="setFilter('hari')">
        Hari ini
    </button>

    <button 
        class="btn btn-light fw-bold {{ $selectedFilter === 'bulan' ? 'active' : '' }}" 
        wire:click="setFilter('bulan')">
        Bulan ini
    </button>

    <button 
        class="btn btn-light fw-bold {{ $selectedFilter === 'tahun' ? 'active' : '' }}" 
        wire:click="setFilter('tahun')">
        Tahun Ini
    </button>

    <button 
        class="btn btn-light fw-bold {{ $selectedFilter === 'periode' ? 'active' : '' }}" 
        wire:click="setFilter('periode')">
        Periode Ini
    </button>

    <style>
        .btn.active {
            background-color: #e0e4f0;
            color: #212529;
        }
    </style>
</div>
