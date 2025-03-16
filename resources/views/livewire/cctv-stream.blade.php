<div class="container py-4">
    <!-- Filter Data -->
    <div class="d-flex gap-3 mb-4">
        <button class="btn btn-light fw-bold {{ $selectedFilter === 'hari' ? 'active' : '' }}" 
            wire:click="setFilter('hari')">
            Hari ini
        </button>
    
        <button class="btn btn-light fw-bold {{ $selectedFilter === 'bulan' ? 'active' : '' }}" 
            wire:click="setFilter('bulan')">
            Bulan ini
        </button>
        
        <button class="btn btn-light fw-bold {{ $selectedFilter === 'tahun' ? 'active' : '' }}" 
            wire:click="setFilter('tahun')">
            Tahun Ini
        </button>
    
        <button class="btn btn-light fw-bold {{ $selectedFilter === 'periode' ? 'active' : '' }}" 
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

    <!-- CCTV Streams -->
    <div class="row justify-content-center mb-4" x-data @update-cctv.window="$wire.updateStream($event.detail)">
        <div class="col-md-6">
            <div class="cctv-container shadow rounded overflow-hidden">
                <div class="m-3">
                    @if($imageUrl)
                        <img src="{{ $imageUrl }}" alt="CCTV Stream" class="img-fluid rounded shadow" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <p class="text-muted">Menunggu data CCTV...</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="cctv-container shadow rounded overflow-hidden" style="height: 450px;">
                <div class="m-4">
                    <h5 class="fw-bold text-center">Deteksi Kendaraan (Terbaru - Maks 100)</h5>
                    <div class="table-responsive" style="max-height: 280px; overflow-y: auto;">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Jenis</th>
                                    <th>Dari Arah</th>
                                    <th>Ke Arah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($detections as $index => $detection)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $detection['class'] }}</td>
                                        <td>{{ ucfirst($detection['dari_arah']) }}</td>
                                        <td>{{ ucfirst($detection['ke_arah']) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center">Tidak ada data</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Volume Jam Perancangan -->
    <div class="row">
        <div class="col-md-6">
            <div class="chart-container shadow rounded p-3 bg-light">
                <div id="designVolumeChart1" style="height: 300px;"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-container shadow rounded p-3 bg-light">
                <div id="designVolumeChart2" style="height: 300px;"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const socket = io("https://sxe-data.layanancerdas.id");
    
            socket.on("result_detection", (data) => {
                // console.log("📡 Data CCTV diterima:", data);
    
                if (!data.message || !data.message.image_url || !data.message.count) {
                    console.warn("⚠️ Data tidak lengkap, diabaikan:", data);
                    return;
                }
    
                window.dispatchEvent(new CustomEvent('update-cctv', { detail: data.message }));
            });
    
            // Simulasi data untuk testing tanpa WebSocket
            function generateRandomData() {
                let sampleData = {
                    "topic": "result_detection",
                    "message": {
                        "id_simpang": 2,
                        "image_url": "https://via.placeholder.com/800x450.png?text=CCTV+Stream",
                        "count": Math.floor(Math.random() * 100),
                        "timestamp": new Date().toISOString(),
                        "fps": (Math.random() * 1).toFixed(2),
                        "detections": [
                            {
                                "class": ["MP", "Car", "Truck", "Bus"][Math.floor(Math.random() * 4)],
                                "dari_arah": ["north", "south", "east", "west"][Math.floor(Math.random() * 4)],
                                "ke_arah": ["north", "south", "east", "west"][Math.floor(Math.random() * 4)]
                            }
                        ]
                    }
                };
    
                console.log("🔄 Simulasi Data CCTV:", sampleData);
                window.dispatchEvent(new CustomEvent('update-cctv', { detail: sampleData.message }));
            }
    
            // Jalankan simulasi setiap 5 detik
            // setInterval(generateRandomData, 5000);
        });
    </script>    
</div>

