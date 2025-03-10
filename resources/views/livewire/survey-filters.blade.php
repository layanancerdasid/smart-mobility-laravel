<div class="card p-3 shadow-sm h-100 d-flex flex-column">
    <div class="row g-2 flex-grow-1">
        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Surveyor</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('surveyor', 'VIANA')">VIANA</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('surveyor', 'manual')">manual</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('surveyor', 'semua')">semua</button>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Waktu Interval</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('interval', '5 menit'); $dispatch('updateFilters', periode, '5 menit')">5 Menit</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('interval', '10 menit'); $dispatch('updateFilters', periode, '10 menit')">10 Menit</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('interval', '15 menit'); $dispatch('updateFilters', periode, '15 menit')">15 Menit</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('interval', 'Jam'); $dispatch('updateFilters', periode, 'Jam')">Jam</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('interval', 'Semua'); $dispatch('updateFilters', periode, 'Jam')">Semua</button>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Pendekat Simpang</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('pendekat', 'Utara')">Utara</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('pendekat', 'Selatan')">Selatan</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('pendekat', 'Timur')">Timur</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('pendekat', 'Barat')">Barat</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('pendekat', 'Semua')">Semua</button>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Arah Pergerakan</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('arah', 'Belok Kiri')">Belok Kiri</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('arah', 'Lurus')">Lurus</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('arah', 'Belok Kanan')">Belok Kanan</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('arah', 'Semua')">Semua</button>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Jenis Klasifikasi</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('klasifikasi', 'PKJI 2023 Luar Kota')">PKJI 2023 Luar Kota</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('klasifikasi', 'PKJI 2023 Dalam Kota')">PKJI 2023 Dalam Kota</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('klasifikasi', 'Tipikal')">Tipikal</button>
            </div>
        </div>
    </div>

    <div class="col-md-12 text-center mt-3">
        <button class="btn btn-success px-4 py-2" wire:click="dispatch('openDownloadModal')">
            Unduh Data <i class="bi bi-download"></i>
        </button>          
    </div>    
</div>
