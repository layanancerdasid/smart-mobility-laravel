<div class="container mt-4">
    <h5 class="fw-bold">Hasil Survei</h5>
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
            @php $currentPeriode = null; @endphp
            @foreach ($data as $row)
                @if ($currentPeriode !== $row['periode'])
                    <tr class="table-primary">
                        <td colspan="6"><strong>{{ $row['periode'] }}</strong></td>
                    </tr>
                    @php $currentPeriode = $row['periode']; @endphp
                @endif
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
