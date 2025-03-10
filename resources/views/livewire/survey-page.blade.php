<div class="container-fluid position-relative">

    <h2 class="mt-4">Survei Lalu Lintas</h2>
    <!-- Filter Dropdown (di atas peta) -->
    <div class="position-absolute top-10 start-50 translate-middle-x w-75 bg-white p-3 rounded shadow" style="z-index: 10; margin-top: 10px;">
        <div class="row g-2 align-items-center">
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <select class="form-select">
                    <option selected>Jenis Lokasi</option>
                    <option value="1">Terminal</option>
                    <option value="2">Persimpangan</option>
                    <option value="3">Jalan Raya</option>
                </select>
            </div>

            <div class="col-md-2">
                <select class="form-select">
                    <option selected>Lokasi</option>
                    <option value="1">Jalan Malioboro</option>
                    <option value="2">Tugu Jogja</option>
                    <option value="3">Stasiun Tugu</option>
                </select>
            </div>

            <div class="col-md-2">
                <input type="date" class="form-control">
            </div>

            <div class="col-md-2">
                <select class="form-select">
                    <option selected>Tampilkan Peta</option>
                    <option value="default">Peta Dasar</option>
                    <option value="traffic">Lalu Lintas</option>
                    <option value="satellite">Satelit</option>
                </select>
            </div>

            <div class="col-md-2">
                <select class="form-select">
                    <option selected>Pilih Kamera</option>
                    <option value="cam1">Kamera 1</option>
                    <option value="cam2">Kamera 2</option>
                    <option value="cam3">Kamera 3</option>
                </select>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>

    <!-- Peta -->
    <div id="map" class="w-100" style="height: 400px; position: relative; z-index: 0;"></div>

    <div class="row row align-items-stretch g-3">
        <div class="col-md-4">
            <livewire:survey-summary />
        </div>
        <div class="col-md-8">
            <livewire:survey-filters wire:model.live="periode" wire:model.live="interval" />
        </div>
    </div>

    <livewire:download-modal />

    <livewire:survey-table wire:model.live="periode" wire:model.live="interval" />
    
    <div class="container mt-4">
        <h5 class="fw-bold">Keterangan Kendaraan</h5>
        <table class="table table-bordered">
            <thead class="table-light text-center">
                <tr>
                    <th>Kode</th>
                    <th>Jenis Kendaraan</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>SM</strong></td>
                    <td>Sepeda Motor</td>
                    <td>Kendaraan bermotor dengan 2 atau 3 roda (Sepeda Motor, Skuter, Becak Motor)</td>
                </tr>
                <tr>
                    <td><strong>KS</strong></td>
                    <td>Kendaraan Sedang</td>
                    <td>Bus Sedang, Truk Sedang (Bus Engkel, Bus Antar Jemput, Mobil Bak, Pickup, Box)</td>
                </tr>
                <tr>
                    <td><strong>KB</strong></td>
                    <td>Kendaraan Berat</td>
                    <td>Bus Besar (Bus AKAP, Bus Wisata, Bus Tingkat), Truk Besar (Tronton, Truk Gandeng)</td>
                </tr>
                <tr>
                    <td><strong>KTB</strong></td>
                    <td>Kendaraan Tidak Bermotor</td>
                    <td>Sepeda, Becak, Gerobak Dorong, Kendaraan ditarik Hewan (Pedati, Delman, Andong)</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <script>
        document.addEventListener('livewire:initialized', function () {
            var map = new maplibregl.Map({
                container: 'map',
                style: {
                    version: 8,
                    sources: {
                        'osm': {
                            type: 'raster',
                            tiles: ["https://tile.openstreetmap.org/{z}/{x}/{y}.png"], // Peta utama
                            tileSize: 256,
                            attribution: '&copy; OpenStreetMap Contributors',
                        }
                    },
                    layers: [{
                        id: 'osm-layer',
                        type: 'raster',
                        source: 'osm'
                    }]
                },
                center: [110.370529, -7.797068],
                zoom: 13
            });

            // Event untuk menambahkan overlay layer
            Livewire.on('addOverlayLayer', function (newLayer) {
                if (newLayer) {
                    console.log("Menambahkan Overlay:", newLayer);
                    
                    if (map.getLayer('overlay-layer')) {
                        map.removeLayer('overlay-layer');
                        map.removeSource('overlay-source');
                    }

                    map.addSource('overlay-source', {
                        type: 'raster',
                        tiles: [newLayer],
                        tileSize: 256
                    });

                    map.addLayer({
                        id: 'overlay-layer',
                        type: 'raster',
                        source: 'overlay-source',
                        paint: {
                            "raster-opacity": 0.7
                        }
                    });

                } else {
                    if (map.getLayer('overlay-layer')) {
                        map.removeLayer('overlay-layer');
                        map.removeSource('overlay-source');
                    }
                }
            });
        });
    </script>
</div>
