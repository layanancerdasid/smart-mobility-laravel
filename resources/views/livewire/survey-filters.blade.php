<div class="card p-3 shadow-sm h-100 d-flex flex-column">
    <div class="row g-2 flex-grow-1">
        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Surveyor</h6>
            <div class="d-flex gap-2 btn-group" role="group">
                <input type="radio" class="btn-check" id="surveyor_viana" value="VIANA" wire:model="surveyor" wire:change="$set('surveyor', 'VIANA')">
                <label for="surveyor_viana" class="btn btn-outline-primary">VIANA</label>
                <input type="radio" class="btn-check" id="surveyor_manual" value="Manual" wire:model="surveyor" wire:change="$set('surveyor', 'Manual')">
                <label for="surveyor_manual" class="btn btn-outline-primary">Manual</label>
                <input type="radio" class="btn-check" id="surveyor_semua" value="Semua" wire:model="surveyor" wire:change="$set('surveyor', 'Semua')">
                <label for="surveyor_semua" class="btn btn-outline-primary">Semua</label>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Waktu Interval</h6>
            <div class="d-flex gap-2 btn-group" role="group">
                <input type="radio" class="btn-check" id="interval_5_menit" value="5 menit" wire:model="interval" wire:change="$set('interval', '5 menit'); $dispatch('updateFilters', '5 menit')">
                <label for="interval_5_menit" class="btn btn-outline-primary">5 Menit</label>
                <input type="radio" class="btn-check" id="interval_10_menit" value="10 menit" wire:model="interval" wire:change="$set('interval', '10 menit'); $dispatch('updateFilters', '10 menit')">
                <label for="interval_10_menit" class="btn btn-outline-primary">10 Menit</label>
                <input type="radio" class="btn-check" id="interval_15_menit" value="15 menit" wire:model="interval" wire:change="$set('interval', '15 menit'); $dispatch('updateFilters', '15 menit')">
                <label for="interval_15_menit" class="btn btn-outline-primary">15 Menit</label>
                <input type="radio" class="btn-check" id="interval_jam" value="Jam" wire:model="interval" wire:change="$set('interval', 'Jam'); $dispatch('updateFilters', 'Jam')">
                <label for="interval_jam" class="btn btn-outline-primary">Jam</label>
                <input type="radio" class="btn-check" id="interval_semua" value="Semua" wire:model="interval" wire:change="$set('interval', 'Semua'); $dispatch('updateFilters', 'Semua')">
                <label for="interval_semua" class="btn btn-outline-primary">Semua</label>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Pendekat Simpang</h6>
            <div class="d-flex gap-2 btn-group" role="group">
                <input type="radio" class="btn-check" id="pendekat_utara" value="Utara" wire:model="pendekat" wire:change="$set('pendekat', 'Utara'); $dispatch('updateFilters', 'Utara')">
                <label for="pendekat_utara" class="btn btn-outline-primary">Utara</label>
                <input type="radio" class="btn-check" id="pendekat_timur" value="Timur" wire:model="pendekat" wire:change="$set('pendekat', 'Timur'); $dispatch('updateFilters', 'Timur')">
                <label for="pendekat_timur" class="btn btn-outline-primary">Timur</label>
                <input type="radio" class="btn-check" id="pendekat_selatan" value="Selatan" wire:model="pendekat" wire:change="$set('pendekat', 'Selatan'); $dispatch('updateFilters', 'Selatan')">
                <label for="pendekat_selatan" class="btn btn-outline-primary">Selatan</label>
                <input type="radio" class="btn-check" id="pendekat_barat" value="Barat" wire:model="pendekat" wire:change="$set('pendekat', 'Barat'); $dispatch('updateFilters', 'Barat')">
                <label for="pendekat_barat" class="btn btn-outline-primary">Barat</label>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Arah Pergerakan</h6>
            <div class="d-flex gap-2 btn-group" role="group">
                <input type="radio" class="btn-check" id="arah_kanan" value="Kanan" wire:model="arah" wire:change="$set('arah', 'Kanan'); $dispatch('updateFilters', 'Kanan')">
                <label for="arah_kanan" class="btn btn-outline-primary">Kanan</label>
                <input type="radio" class="btn-check" id="arah_lurus" value="Lurus" wire:model="arah" wire:change="$set('arah', 'Lurus'); $dispatch('updateFilters', 'Lurus')">
                <label for="arah_lurus" class="btn btn-outline-primary">Lurus</label>
                <input type="radio" class="btn-check" id="arah_kiri" value="Kiri" wire:model="arah" wire:change="$set('arah', 'Kiri'); $dispatch('updateFilters', 'Kiri')">
                <label for="arah_kiri" class="btn btn-outline-primary">Kiri</label>
            </div>
        </div>

        <div class="col-md-12">
            <h6 class="fw-bold">Pilih Jenis Klasifikasi</h6>
            <div class="d-flex gap-2 btn-group" role="group">
                <input type="radio" class="btn-check" id="klasifikasi_luar_kota" value="PKJI 2023 Luar Kota" wire:model="klasifikasi" wire:change="$set('klasifikasi', 'PKJI 2023 Luar Kota'); $dispatch('updateFilters', 'PKJI 2023 Luar Kota')">
                <label for="klasifikasi_luar_kota" class="btn btn-outline-primary">PKJI 2023 Luar Kota</label>
                <input type="radio" class="btn-check" id="klasifikasi_dalam_kota" value="PKJI 2023 Dalam Kota" wire:model="klasifikasi" wire:change="$set('klasifikasi', 'PKJI 2023 Dalam Kota'); $dispatch('updateFilters', 'PKJI 2023 Dalam Kota')">
                <label for="klasifikasi_dalam_kota" class="btn btn-outline-primary">PKJI 2023 Dalam Kota</label>
                <input type="radio" class="btn-check" id="klasifikasi_tipikal" value="Tipikal" wire:model="klasifikasi" wire:change="$set('klasifikasi', 'Tipikal'); $dispatch('updateFilters', 'Tipikal')">
                <label for="klasifikasi_tipikal" class="btn btn-outline-primary">Tipikal</label>
            </div>
        </div>
    </div>

    <div class="col-md-12 text-center mt-3">
        <button class="btn btn-success px-4 py-2" wire:click="dispatch('openDownloadModal')">
            Unduh Data <i class="bi bi-download"></i>
        </button>          
    </div>    
</div>
