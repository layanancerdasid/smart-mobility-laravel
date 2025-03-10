<div>
    <!-- Modal Bootstrap -->
    <div class="modal fade @if($showModal) show d-block @endif" tabindex="-1" role="dialog" style="background: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog modal-lg">
            <div class="modal-content p-3 rounded" style="background-color: #E0E7FF; border-radius: 12px;">
                <div class="modal-header border-0">
                    <h5 class="fw-bold text-center w-100">Unduh Data</h5>
                    <button type="button" class="btn-close" wire:click="hide"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="fw-bold">Dari Tanggal</label>
                                <input type="date" class="form-control" wire:model.live="startDate">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-bold">Sampai Tanggal</label>
                                <input type="date" class="form-control" wire:model.live="endDate">
                            </div>

                            <div class="col-md-12 mt-2">
                                <h6 class="fw-bold">Pilih Surveyor</h6>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-primary flex-fill">VIANA</button>
                                    <button class="btn btn-outline-primary flex-fill">manual</button>
                                    <button class="btn btn-outline-primary flex-fill">semua</button>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <h6 class="fw-bold">Pilih Waktu Interval</h6>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-primary flex-fill">5 menit</button>
                                    <button class="btn btn-outline-primary flex-fill">10 menit</button>
                                    <button class="btn btn-outline-primary flex-fill">15 menit</button>
                                    <button class="btn btn-outline-primary flex-fill">Jam</button>
                                    <button class="btn btn-outline-primary flex-fill">semua</button>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <h6 class="fw-bold">Pilih Pendekat Simpang</h6>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-primary flex-fill">Utara</button>
                                    <button class="btn btn-outline-primary flex-fill">Selatan</button>
                                    <button class="btn btn-outline-primary flex-fill">Timur</button>
                                    <button class="btn btn-outline-primary flex-fill">Barat</button>
                                    <button class="btn btn-outline-primary flex-fill">Semua</button>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <h6 class="fw-bold">Pilih Arah Pergerakan</h6>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-primary flex-fill">Belok kiri</button>
                                    <button class="btn btn-outline-primary flex-fill">Lurus</button>
                                    <button class="btn btn-outline-primary flex-fill">Belok kanan</button>
                                    <button class="btn btn-outline-primary flex-fill">semua</button>
                                </div>
                            </div>

                            <div class="col-md-12 mt-2">
                                <h6 class="fw-bold">Pilih Jenis Klasifikasi</h6>
                                <div class="d-flex gap-2">
                                    <button class="btn btn-outline-primary flex-fill">PKJI 2023 Luar Kota</button>
                                    <button class="btn btn-outline-primary flex-fill">PKJI 2023 Dalam Kota</button>
                                    <button class="btn btn-outline-primary flex-fill">Tipikal</button>
                                </div>
                            </div>

                            <div class="col-md-12 text-center mt-3">
                                <button class="btn btn-success px-4 py-2" wire:click="downloadData">
                                    Unduh <i class="bi bi-download"></i>
                                </button>
                                <button class="btn btn-danger px-4 py-2 ms-2" wire:click="hide">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
