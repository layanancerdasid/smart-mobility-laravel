<div class="container-fluid">
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tombol Tambah Kamera -->
    <div class="mb-3 text-end">
        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#tambahKameraModal">
            <i class="bi bi-plus"></i> Tambah Kamera
        </button>
    </div>

    <!-- Daftar Kamera -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach ($cameras as $camera)
            <div class="col">
                <div class="card camera-card position-relative">
                    <a href="{{ $camera['url'] }}" target="_blank">
                        <img src="{{ $camera['thumbnail_url'] ?? 'default-thumbnail.jpg' }}" class="card-img-top"
                            alt="{{ $camera['name'] }}">
                    </a>
                    <div class="camera-status {{ $camera['status'] ? 'active' : 'inactive' }}">
                        <i class="bi bi-record-circle-fill"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $camera['name'] }}</h5>
                        <p class="card-text">
                            <strong>Lokasi:</strong> {{ $camera['location'] }}<br>
                            <strong>Status:</strong>
                            <span class="badge {{ $camera['status'] ? 'bg-success' : 'bg-danger' }}">
                                {{ $camera['status'] ? 'Aktif' : 'Non-Aktif' }}
                            </span><br>
                            <strong>Resolusi:</strong> {{ $camera['resolution'] }}
                        </p>
                        <div class="d-flex justify-content-between">
                            <button wire:click="editCamera({{ $camera['id'] }})" class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="modal" data-bs-target="#editKameraModal">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <button wire:click="deleteCamera({{ $camera['id'] }})"
                                class="btn btn-sm btn-outline-danger"
                                onclick="confirm('Yakin ingin menghapus kamera?') || event.stopImmediatePropagation()">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Tambah Kamera -->
    <div class="modal fade" id="tambahKameraModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Tambah Kamera Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="addCamera">
                        <div class="mb-3">
                            <label class="form-label">Nama Kamera</label>
                            <input type="text" class="form-control" wire:model.live="newCameraName"
                                placeholder="Masukkan nama kamera" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL Kamera</label>
                            <input type="url" class="form-control" wire:model.live="newCameraUrl"
                                placeholder="Masukkan URL kamera" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control" wire:model.live="newCameraLocation"
                                placeholder="Lokasi pemasangan kamera" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Resolusi</label>
                            <select class="form-select" wire:model.live="newCameraResolution" required>
                                <option value="">Pilih Resolusi</option>
                                <option>720p</option>
                                <option>1080p</option>
                                <option>4K</option>
                            </select>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="statusKamera"
                                wire:model.live="newCameraStatus">
                            <label class="form-check-label">Aktifkan Kamera</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kamera -->
    <div class="modal fade" id="editKameraModal" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Edit Kamera</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit="updateCamera">
                        <div class="mb-3">
                            <label class="form-label">Nama Kamera</label>
                            <input type="text" class="form-control" wire:model.live="editCameraName"
                                placeholder="Masukkan nama kamera" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL Kamera</label>
                            <input type="url" class="form-control" wire:model.live="editCameraUrl"
                                placeholder="Masukkan URL kamera" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi</label>
                            <input type="text" class="form-control" wire:model.live="editCameraLocation"
                                placeholder="Lokasi pemasangan kamera" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Resolusi</label>
                            <select class="form-select" wire:model.live="editCameraResolution" required>
                                <option value="720p">720p</option>
                                <option value="1080p">1080p</option>
                                <option value="4K">4K</option>
                            </select>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="editStatusKamera"
                                wire:model.live="editCameraStatus">
                            <label class="form-check-label">Aktifkan Kamera</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('close-modal', () => {
            var modalElements = document.querySelectorAll('.modal');
            modalElements.forEach(function(modalEl) {
                var modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) {
                    modal.hide();
                }
            });
            // Hapus backdrop jika ada
            var backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        });
    });
</script>
