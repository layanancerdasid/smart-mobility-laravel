<div class="container">
    <div class="table-responsive">

        <!-- Input Pencarian -->
        <div class="mb-3">
            <input type="text" wire:model.live.debounce.500ms="search" class="form-control"
                placeholder="Cari simpang atau arah..." />
        </div>

        <h2>Arus Barat</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Total</th>
                    <th>MC</th>
                    <th>LV</th>
                    <th>HV</th>
                    <th>UM</th>
                </tr>
            </thead>
            <tbody>
                @if ($intersectionsBarat)
                    <tr>
                        <td>{{ $totalCounts['totalMCBarat'] + $totalCounts['totalLVBarat'] + $totalCounts['totalHVBarat'] + $totalCounts['totalUMBarat'] }}
                        </td>
                        <td>{{ $totalCounts['totalMCBarat'] }}</td>
                        <td>{{ $totalCounts['totalLVBarat'] }}</td>
                        <td>{{ $totalCounts['totalHVBarat'] }}</td>
                        <td>{{ $totalCounts['totalUMBarat'] }}</td>
                    </tr>
                @endif
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{-- {{ $intersectionsBarat->links() }} --}}
        </div>

        <h2>Arus Selatan</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Total</th>
                    <th>MC</th>
                    <th>LV</th>
                    <th>HV</th>
                    <th>UM</th>
                </tr>
            </thead>
            <tbody>
                @if ($intersectionsSelatan)
                    <tr>
                        <td>{{ $totalCounts['totalMCSelatan'] + $totalCounts['totalLVSelatan'] + $totalCounts['totalHVSelatan'] + $totalCounts['totalUMSelatan'] }}
                        </td>
                        <td>{{ $totalCounts['totalMCSelatan'] }}</td>
                        <td>{{ $totalCounts['totalLVSelatan'] }}</td>
                        <td>{{ $totalCounts['totalHVSelatan'] }}</td>
                        <td>{{ $totalCounts['totalUMSelatan'] }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{-- {{ $intersectionsSelatan->links() }} --}}

        <h2>Arus Timur</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Total</th>
                    <th>MC</th>
                    <th>LV</th>
                    <th>HV</th>
                    <th>UM</th>
                </tr>
            </thead>
            <tbody>
                @if ($intersectionsTimur)
                    <tr>
                        <td>{{ $totalCounts['totalMCTimur'] + $totalCounts['totalLVTimur'] + $totalCounts['totalHVTimur'] + $totalCounts['totalUMTimur'] }}
                        </td>
                        <td>{{ $totalCounts['totalMCTimur'] }}</td>
                        <td>{{ $totalCounts['totalLVTimur'] }}</td>
                        <td>{{ $totalCounts['totalHVTimur'] }}</td>
                        <td>{{ $totalCounts['totalUMTimur'] }}</td>
                    </tr>
                @endif
                {{-- <tr>
                    <th>Total</th>
                    <th>MC</th>
                    <th>LV</th>
                    <th>HV</th>
                    <th>UM</th>
                </tr> --}}
            </tbody>
        </table>
        {{-- {{ $intersectionsTimur->links() }} --}}

        <h2>Arus Utara</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Total</th>
                    <th>MC</th>
                    <th>LV</th>
                    <th>HV</th>
                    <th>UM</th>
                </tr>
            </thead>
            <tbody>
                @if ($intersectionsUtara)
                    <tr>
                        <td>{{ $totalCounts['totalMCUtara'] + $totalCounts['totalLVUtara'] + $totalCounts['totalHVUtara'] + $totalCounts['totalUMUtara'] }}
                        </td>
                        <td>{{ $totalCounts['totalMCUtara'] }}</td>
                        <td>{{ $totalCounts['totalLVUtara'] }}</td>
                        <td>{{ $totalCounts['totalHVUtara'] }}</td>
                        <td>{{ $totalCounts['totalUMUtara'] }}</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{-- {{ $intersectionsUtara->links() }} --}}

        <h2>Total Rekapitulasi</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Total MC</th>
                    <th>Total LV</th>
                    <th>Total HV</th>
                    <th>Total UM</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $totalCounts['totalMC'] }}</td>
                    <td>{{ $totalCounts['totalLV'] }}</td>
                    <td>{{ $totalCounts['totalHV'] }}</td>
                    <td>{{ $totalCounts['totalUM'] }}</td>
                </tr>
            </tbody>
        </table>



        {{-- @foreach ($inOutData as $direction => $data)
            <h2>Data {{ $direction }}</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Jenis</th>
                        <th>Total</th>
                        <th>MC</th>
                        <th>LV</th>
                        <th>HV</th>
                        <th>UM</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Belok Kiri ({{ $data['labels']['Belok Kiri'] }})</td>
                        <td>{{ $data['out']->MC + $data['out']->LV + $data['out']->HV + $data['out']->UM }}</td>
                        <td>{{ $data['out']->MC }}</td>
                        <td>{{ $data['out']->LV }}</td>
                        <td>{{ $data['out']->HV }}</td>
                        <td>{{ $data['out']->UM }}</td>
                    </tr>
                    <tr>
                        <td>Jalan Lurus ({{ $data['labels']['Jalan Lurus'] }})</td>
                        <td>{{ $data['out']->MC + $data['out']->LV + $data['out']->HV + $data['out']->UM }}</td>
                        <td>{{ $data['out']->MC }}</td>
                        <td>{{ $data['out']->LV }}</td>
                        <td>{{ $data['out']->HV }}</td>
                        <td>{{ $data['out']->UM }}</td>
                    </tr>
                    <tr>
                        <td>Belok Kanan ({{ $data['labels']['Belok Kanan'] }})</td>
                        <td>{{ $data['out']->MC + $data['out']->LV + $data['out']->HV + $data['out']->UM }}</td>
                        <td>{{ $data['out']->MC }}</td>
                        <td>{{ $data['out']->LV }}</td>
                        <td>{{ $data['out']->HV }}</td>
                        <td>{{ $data['out']->UM }}</td>
                    </tr>
                    <tr>
                        <td>Masuk</td>
                        <td>{{ $data['in']->MC + $data['in']->LV + $data['in']->HV + $data['in']->UM }}</td>
                        <td>{{ $data['in']->MC }}</td>
                        <td>{{ $data['in']->LV }}</td>
                        <td>{{ $data['in']->HV }}</td>
                        <td>{{ $data['in']->UM }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach --}}

        <div class="row">
            <div class="col-6">
                <div class="container-fluid p-2">
                    <!-- Utara Section -->
                    <div class="row justify-content-center mb-3">
                        <div class="col-6">
                            <h5 class="text-center mb-2">Utara</h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered small">
                                    <tbody>
                                        <tr>
                                            @foreach ($utaraTrafficFlow as $key => $arah)
                                                <td>{{ $arah['arus'] }}</td>
                                            @endforeach
                                            <th>Jenis</th>
                                        </tr>
                                        <tr>
                                            @foreach ($utaraTrafficFlow as $key => $arah)
                                                <td class="bg-warning">{{ $arah['total'] }}</td>
                                            @endforeach
                                            <th>Total</th>
                                        </tr>
                                        <tr>
                                            @foreach ($utaraTrafficFlow as $key => $arah)
                                                <td>{{ $arah['MC'] }}</td>
                                            @endforeach
                                            <th>MC</th>
                                        </tr>
                                        <tr>
                                            @foreach ($utaraTrafficFlow as $key => $arah)
                                                <td>{{ $arah['LV'] }}</td>
                                            @endforeach
                                            <th>LV</th>
                                        </tr>
                                        <tr>
                                            @foreach ($utaraTrafficFlow as $key => $arah)
                                                <td>{{ $arah['HV'] }}</td>
                                            @endforeach
                                            <th>HV</th>
                                        </tr>
                                        <tr>
                                            @foreach ($utaraTrafficFlow as $key => $arah)
                                                <td>{{ $arah['UM'] }}</td>
                                            @endforeach
                                            <th>UM</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Barat and Timur Section -->
                    <div class="row mb-3">
                        <div class="col-5">
                            <h5 class="text-center mb-2">Barat</h5>
                            <table class="table table-sm table-striped table-bordered small">
                                <thead>
                                    <tr>
                                        <th>Jenis</th>
                                        <th>Total</th>
                                        <th>MC</th>
                                        <th>LV</th>
                                        <th>HV</th>
                                        <th>UM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($baratTrafficFlow as $key => $arah)
                                        <tr>
                                            <td>{{ $arah['arus'] }}</td>
                                            <td class="bg-warning">{{ $arah['total'] }}</td>
                                            <td>{{ $arah['MC'] }}</td>
                                            <td>{{ $arah['LV'] }}</td>
                                            <td>{{ $arah['HV'] }}</td>
                                            <td>{{ $arah['UM'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-2">
                            <!-- Spacer column -->
                        </div>
                        <div class="col-5">
                            <h5 class="text-center mb-2">Timur</h5>
                            <table class="table table-sm table-striped table-bordered small">
                                <tbody>
                                    @foreach ($timurTrafficFlow as $key => $arah)
                                        <tr>
                                            <td>{{ $arah['MC'] }}</td>
                                            <td>{{ $arah['LV'] }}</td>
                                            <td>{{ $arah['HV'] }}</td>
                                            <td>{{ $arah['UM'] }}</td>
                                            <td class="bg-warning">{{ $arah['total'] }}</td>
                                            <td>{{ $arah['arus'] }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th>MC</th>
                                        <th>LV</th>
                                        <th>HV</th>
                                        <th>UM</th>
                                        <th>Total</th>
                                        <th>Jenis</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Selatan Section -->
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <h5 class="text-center mb-2">Selatan</h5>
                            <table class="table table-sm table-striped table-bordered small">
                                <tbody>
                                    <tr>
                                        <th>MC</th>
                                        @foreach ($selatanTrafficFlow as $key => $arah)
                                            <td>{{ $arah['MC'] }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>LV</th>
                                        @foreach ($selatanTrafficFlow as $key => $arah)
                                            <td>{{ $arah['LV'] }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>HV</th>
                                        @foreach ($selatanTrafficFlow as $key => $arah)
                                            <td>{{ $arah['HV'] }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>UM</th>
                                        @foreach ($selatanTrafficFlow as $key => $arah)
                                            <td>{{ $arah['UM'] }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        @foreach ($selatanTrafficFlow as $key => $arah)
                                            <td class="bg-warning">{{ $arah['total'] }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th>Jenis</th>
                                        @foreach ($selatanTrafficFlow as $key => $arah)
                                            <td>{{ $arah['arus'] }}</td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="container vh-100">
                    <h2>Data Gabungan Berdasarkan Arah</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Arah</th>
                                <th>Total MC</th>
                                <th>Total LV</th>
                                <th>Total HV</th>
                                <th>Total UM</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($combinedData as $arah => $data)
                                <tr>
                                    <td>{{ $arah }}</td>
                                    <td>{{ $data->MC }}</td>
                                    <td>{{ $data->LV }}</td>
                                    <td>{{ $data->HV }}</td>
                                    <td>{{ $data->UM }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
