<div class="container mt-4">
    <h5 class="fw-bold">Hasil Survei</h5>

    <pre>@json($data)</pre>
    
    <!-- Tabel Hasil -->
    <table class="table table-bordered text-center">
        <thead class="table-light">
            <tr>
                <th rowspan="2">Periode</th>
                <th rowspan="2">Waktu</th>
                <th colspan="4">Kendaraan Bermotor</th>
            </tr>
            <tr>
                <th>SM</th>
                <th>KS</th>
                <th>KB</th>
                <th>KTB</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row['periode'] }}</td>
                    <td>{{ $row['waktu'] }}</td>
                    <td>{{ $row['sm'] }}</td>
                    <td>{{ $row['ks'] }}</td>
                    <td>{{ $row['kb'] }}</td>
                    <td>{{ $row['ktb'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


{{-- <div class="container mt-4">
    <h5 class="fw-bold">Hasil Survei</h5>
    <p>Livewire Berjalan dengan Baik!</p>
</div> --}}
