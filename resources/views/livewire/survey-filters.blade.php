<div class="card p-3 shadow-sm h-100 d-flex flex-column">
    <div class="row g-2 flex-grow-1">
        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Surveyor</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary flex-fill">VIANA</button>
                <button class="btn btn-outline-primary flex-fill">manual</button>
                <button class="btn btn-outline-primary flex-fill">semua</button>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Waktu Interval</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('interval', '5 menit')">5 menit</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('interval', '10 menit')">10 menit</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('interval', '15 menit')">15 menit</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('interval', 'Jam')">Jam</button>
                <button class="btn btn-outline-primary flex-fill" wire:click="$set('interval', 'Semua')">Semua</button>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Pendekat Simpang</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary flex-fill">Utara</button>
                <button class="btn btn-outline-primary flex-fill">Selatan</button>
                <button class="btn btn-outline-primary flex-fill">Timur</button>
                <button class="btn btn-outline-primary flex-fill">Barat</button>
                <button class="btn btn-outline-primary flex-fill">Semua</button>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Arah Pergerakan</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary flex-fill">Belok Kiri</button>
                <button class="btn btn-outline-primary flex-fill">Lurus</button>
                <button class="btn btn-outline-primary flex-fill">Belok Kanan</button>
                <button class="btn btn-outline-primary flex-fill">Semua</button>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Jenis Klasifikasi</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary flex-fill">PKJI 2023 Luar Kota</button>
                <button class="btn btn-outline-primary flex-fill">PKJI 2023 Dalam Kota</button>
                <button class="btn btn-outline-primary flex-fill">Tipikal</button>
            </div>
        </div>
    </div>

    <div class="col-md-12 text-center mt-3">
        <button class="btn btn-success px-4 py-2" wire:click="dispatch('openDownloadModal')">
            Unduh Data <i class="bi bi-download"></i>
        </button>          
    </div>    
</div>
