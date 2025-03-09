{{-- <div class="card p-3 shadow-sm">
    <h5 class="fw-bold">Formulir</h5>
    <table class="table table-bordered">
        @foreach($surveyData as $key => $value)
            <tr>
                <th class="bg-light">{{ $key }}</th>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
    </table>
</div> --}}
<div class="card p-3 shadow-sm h-100 d-flex flex-column">
    <h5 class="fw-bold">Formulir</h5>
    <table class="table table-bordered flex-grow-1">
        @foreach($surveyData as $key => $value)
            <tr>
                <th class="bg-light">{{ $key }}</th>
                <td>{{ $value }}</td>
            </tr>
        @endforeach
    </table>
</div>