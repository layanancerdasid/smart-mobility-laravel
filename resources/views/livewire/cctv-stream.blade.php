<div>
    <div class="text-center mb-3">
        <h4>Jumlah Kendaraan: {{ $vehicleCount }}</h4>
    </div>

    <div class="d-flex justify-content-center gap-3">
        <div class="cctv-container">
            @if($imageUrl)
                <img src="{{ $imageUrl }}" alt="CCTV Stream" class="img-fluid rounded shadow">
            @else
                <p class="text-muted">Menunggu data CCTV...</p>
            @endif
        </div>
    </div>

    <!-- Tabel Deteksi Kendaraan -->
    <div class="mt-3">
        <h5>Deteksi Kendaraan</h5>
        <table class="table table-sm table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Jenis</th>
                    <th>Dari Arah</th>
                    <th>Ke Arah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($detections as $detection)
                    <tr>
                        <td>{{ $detection['class'] }}</td>
                        <td>{{ ucfirst($detection['dari_arah']) }}</td>
                        <td>{{ ucfirst($detection['ke_arah']) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center">Tidak ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- WebSocket Listener -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const socket = io("https://sxe-data.layanancerdas.id");

            socket.on("result_detection", (data) => {
                console.log("Data CCTV diterima:", data);
                Livewire.dispatch('updateCCTV', data.message);
            });
        });
    </script>
</div>
