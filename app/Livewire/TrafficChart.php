<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class TrafficChart extends Component
{
    public $selectedOrigin = 'all'; // Default: Semua asal kendaraan
    public $selectedFilter = 'hari'; // Default filter periode
    public $jenisKendaraan2 = [];
    public $jenisKendaraanMasuk = [];
    public $jenisKendaraanKeluar = [];

    protected $listeners = ['updateFilter'];

    public function mount()
    {
        $this->fetchData(); // Ambil data saat pertama kali dimuat
        $this->fetchBreakdownMasuk();
        $this->fetchBreakdownKeluar();
    }

    public function updateFilter($filter)
    {
        $this->selectedFilter = $filter;
        $this->fetchData(); // Update data setelah filter berubah
        $this->fetchBreakdownMasuk();
        $this->fetchBreakdownKeluar();
    }

    public function setOrigin($origin)
    {
        $this->selectedOrigin = $origin;
        $this->fetchData();
        $this->fetchBreakdownMasuk();
        $this->fetchBreakdownKeluar();
        // $this->dispatch('updateCharts', $origin);
    }

    public function fetchData()
    {
        $periode = $this->selectedFilter;
        $id_simpang = $this->mapOriginToSimpang($this->selectedOrigin);

        // Panggil Stored Procedure langsung dari Livewire
        $data = DB::select("CALL get_total_traffic(?, ?)", [$id_simpang, $periode]);

        // Mapping data untuk Highcharts
        $this->jenisKendaraan2 = collect($data)->map(function ($item) {
            return [
                'name' => $item->waktu_periode,
                'masuk' => $item->total_masuk,
                'keluar' => -$item->total_keluar, // Masuk dibuat negatif untuk visualisasi diverging chart
            ];
        })->toArray();

        // 🔥 Kirim data ke frontend via Livewire dispatch
        $this->dispatch('updateChartData2', detail: $this->jenisKendaraan2);
    }


    public function fetchBreakdownMasuk()
    {
        $periode = $this->selectedFilter;
        $id_simpang = $this->mapOriginToSimpang($this->selectedOrigin);

        $data = DB::select("CALL get_breakdown_masuk(?, ?)", [$id_simpang, $periode]);

        $this->jenisKendaraanMasuk = collect($data)->map(function ($item) {
            return [
                'name' => $item->waktu_periode,
                'SM' => $item->SM,
                'MP' => $item->MP,
                'TR' => $item->TR,
                'BS' => $item->BS,
                'TS' => $item->TS,
                'BB' => $item->BB,
                'Gandeng' => $item->Gandeng,
                'KTB' => $item->KTB,
            ];
        })->toArray();

        $this->dispatch('updateChartBreakdownMasuk', detail: $this->jenisKendaraanMasuk);
    }

    public function fetchBreakdownKeluar()
    {
        $periode = $this->selectedFilter;
        $id_simpang = $this->mapOriginToSimpang($this->selectedOrigin);

        // $data = DB::select("CALL get_breakdown_keluar(?, ?)", [$id_simpang, $periode]);
        $data = DB::select("CALL get_breakdown_masuk(?, ?)", [$id_simpang, $periode]);


        $this->jenisKendaraanKeluar = collect($data)->map(function ($item) {
            return [
                'name' => $item->waktu_periode,
                'SM' => $item->SM,
                'MP' => $item->MP,
                'TR' => $item->TR,
                'BS' => $item->BS,
                'TS' => $item->TS,
                'BB' => $item->BB,
                'Gandeng' => $item->Gandeng,
                'KTB' => $item->KTB,
            ];
        })->toArray();

        $this->dispatch('updateChartBreakdownKeluar', detail: $this->jenisKendaraanKeluar);
    }


    private function mapOriginToSimpang($origin)
    {
        $mapping = [
            'utara' => 1,
            'timur' => 2,
            'selatan' => 3,
            'barat' => 4,
            'all' => -1
        ];

        return $mapping[$origin] ?? -1;
    }

    public function render()
    {
        return view('livewire.traffic-chart');
    }
}
