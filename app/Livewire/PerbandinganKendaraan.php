<?php

// namespace App\Livewire;

// use Illuminate\Support\Facades\DB;
// use Livewire\Component;

// class PerbandinganKendaraan extends Component
// {
//     public $jenisKendaraan = [];
//     public $selectedFilter = 'hari'; // Default filter

//     public $dataArah = [
//         [
//             'arah' => 'Utara',
//             'lokasi' => 'Tempel',
//             'totalMasuk' => 100,
//             'totalKeluar' => 120,
//             'jenis' => [
//                 ['name' => 'Motor', 'masuk' => 30, 'keluar' => 20, 'color' => '#F39C12'],
//                 ['name' => 'Mobil', 'masuk' => 25, 'keluar' => 40, 'color' => '#2ECC71'],
//                 ['name' => 'Bus', 'masuk' => 20, 'keluar' => 30, 'color' => '#34495E'],
//                 ['name' => 'Truk', 'masuk' => 25, 'keluar' => 30, 'color' => '#E74C3C']
//             ]
//         ],
//         [
//             'arah' => 'Selatan',
//             'lokasi' => 'Prambanan',
//             'totalMasuk' => 90,
//             'totalKeluar' => 110,
//             'jenis' => [
//                 ['name' => 'Motor', 'masuk' => 20, 'keluar' => 25, 'color' => '#F39C12'],
//                 ['name' => 'Mobil', 'masuk' => 30, 'keluar' => 35, 'color' => '#2ECC71'],
//                 ['name' => 'Bus', 'masuk' => 15, 'keluar' => 25, 'color' => '#34495E'],
//                 ['name' => 'Truk', 'masuk' => 25, 'keluar' => 25, 'color' => '#E74C3C']
//             ]
//         ],
//         [
//             'arah' => 'Timur',
//             'lokasi' => 'Piyungan',
//             'totalMasuk' => 80,
//             'totalKeluar' => 95,
//             'jenis' => [
//                 ['name' => 'Motor', 'masuk' => 25, 'keluar' => 20, 'color' => '#F39C12'],
//                 ['name' => 'Mobil', 'masuk' => 20, 'keluar' => 30, 'color' => '#2ECC71'],
//                 ['name' => 'Bus', 'masuk' => 15, 'keluar' => 20, 'color' => '#34495E'],
//                 ['name' => 'Truk', 'masuk' => 20, 'keluar' => 25, 'color' => '#E74C3C']
//             ]
//         ],
//         [
//             'arah' => 'Barat',
//             'lokasi' => 'Glagah',
//             'totalMasuk' => 110,
//             'totalKeluar' => 130,
//             'jenis' => [
//                 ['name' => 'Motor', 'masuk' => 35, 'keluar' => 40, 'color' => '#F39C12'],
//                 ['name' => 'Mobil', 'masuk' => 25, 'keluar' => 35, 'color' => '#2ECC71'],
//                 ['name' => 'Bus', 'masuk' => 25, 'keluar' => 30, 'color' => '#34495E'],
//                 ['name' => 'Truk', 'masuk' => 25, 'keluar' => 25, 'color' => '#E74C3C']
//             ]
//         ]
//     ];

//     protected $listeners = ['updateFilter', 'requestChartUpdate' => 'sendChartData'];

//     public function mount()
//     {
//         $this->fetchData();
//     }

//     public function updateFilter($filter)
//     {
//         $this->selectedFilter = $filter;
//         $this->fetchData(); // Update data setelah filter berubah
//     }

//     public function sendChartData()
//     {
//         $this->dispatch('updateChart', jenisKendaraan: $this->jenisKendaraan);
//     }

//     public function fetchData()
//     {
//         $periode = $this->selectedFilter; // 'hari', 'bulan', atau 'tahun'
    
//         $data = DB::select("CALL get_kendaraan_statistik(?)", [$periode]);
    
//         // Konversi hasil query ke format yang sama seperti versi lama
//         $this->jenisKendaraan = collect($data)->map(function ($item) {
//             return [
//                 'name' => $this->mapJenisKendaraan($item->jenis), // Ubah kode kendaraan jadi nama yang dipakai chart
//                 'masuk' => -$item->total_masuk,  // Masuk dibuat negatif untuk grafik
//                 'keluar' => $item->total_keluar,
//             ];
//         })->toArray();
//     }    

//     public function render()
//     {
//         return view('livewire.perbandingan-kendaraan');
//     }

//     private function mapJenisKendaraan($kode)
//     {
//         $mapping = [
//             'SM' => 'Sepeda Motor',
//             'MP' => 'Mobil Pribadi',
//             'AUP' => 'Angkutan Umum Penumpang',
//             'TR' => 'Truk Ringan',
//             'BS' => 'Bus Sedang',
//             'TS' => 'Bus Sedang',
//             'BB' => 'Bus Besar',
//             'TB' => 'Truk Berat',
//             'Gandeng' => 'Gandeng',
//             'KTB' => 'Kendaraan Tak Bermotor'
//         ];

//         return $mapping[$kode] ?? $kode;
//     }
// }


namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PerbandinganKendaraan extends Component
{
    public $jenisKendaraan = [];
    public $selectedFilter = 'hari'; // Default filter

    public $dataArah = [
        [
            'arah' => 'Utara',
            'lokasi' => 'Tempel',
            'totalMasuk' => 100,
            'totalKeluar' => 120,
            'jenis' => [
                ['name' => 'Motor', 'masuk' => 30, 'keluar' => 20, 'color' => '#F39C12'],
                ['name' => 'Mobil', 'masuk' => 25, 'keluar' => 40, 'color' => '#2ECC71'],
                ['name' => 'Bus', 'masuk' => 20, 'keluar' => 30, 'color' => '#34495E'],
                ['name' => 'Truk', 'masuk' => 25, 'keluar' => 30, 'color' => '#E74C3C']
            ]
        ],
        [
            'arah' => 'Selatan',
            'lokasi' => 'Prambanan',
            'totalMasuk' => 90,
            'totalKeluar' => 110,
            'jenis' => [
                ['name' => 'Motor', 'masuk' => 20, 'keluar' => 25, 'color' => '#F39C12'],
                ['name' => 'Mobil', 'masuk' => 30, 'keluar' => 35, 'color' => '#2ECC71'],
                ['name' => 'Bus', 'masuk' => 15, 'keluar' => 25, 'color' => '#34495E'],
                ['name' => 'Truk', 'masuk' => 25, 'keluar' => 25, 'color' => '#E74C3C']
            ]
        ],
        [
            'arah' => 'Timur',
            'lokasi' => 'Piyungan',
            'totalMasuk' => 80,
            'totalKeluar' => 95,
            'jenis' => [
                ['name' => 'Motor', 'masuk' => 25, 'keluar' => 20, 'color' => '#F39C12'],
                ['name' => 'Mobil', 'masuk' => 20, 'keluar' => 30, 'color' => '#2ECC71'],
                ['name' => 'Bus', 'masuk' => 15, 'keluar' => 20, 'color' => '#34495E'],
                ['name' => 'Truk', 'masuk' => 20, 'keluar' => 25, 'color' => '#E74C3C']
            ]
        ],
        [
            'arah' => 'Barat',
            'lokasi' => 'Glagah',
            'totalMasuk' => 110,
            'totalKeluar' => 130,
            'jenis' => [
                ['name' => 'Motor', 'masuk' => 35, 'keluar' => 40, 'color' => '#F39C12'],
                ['name' => 'Mobil', 'masuk' => 25, 'keluar' => 35, 'color' => '#2ECC71'],
                ['name' => 'Bus', 'masuk' => 25, 'keluar' => 30, 'color' => '#34495E'],
                ['name' => 'Truk', 'masuk' => 25, 'keluar' => 25, 'color' => '#E74C3C']
            ]
        ]
    ];

    protected $listeners = ['updateFilter'];

    public function mount()
    {
        $this->fetchData();
    }

    public function updateFilter($filter)
    {
        $this->selectedFilter = $filter;
        $this->fetchData(); // Update data setelah filter berubah
    }

    public function fetchData()
    {
        $periode = $this->selectedFilter;
        $data = DB::select("CALL get_kendaraan_statistik(?)", [$periode]);

        $this->jenisKendaraan = collect($data)->map(function ($item) {
            return [
                'name' => $this->mapJenisKendaraan($item->jenis),
                'masuk' => -$item->total_masuk,  // Masuk dibuat negatif untuk grafik
                'keluar' => $item->total_keluar,
            ];
        })->toArray();

        // 🔥 Gunakan dispatch() agar Alpine.js bisa menangkap update dari Livewire
        $this->dispatch('updateChartData', detail: $this->jenisKendaraan);
    }

    public function render()
    {
        return view('livewire.perbandingan-kendaraan');
    }

    private function mapJenisKendaraan($kode)
    {
        $mapping = [
            'SM' => 'Sepeda Motor',
            'MP' => 'Mobil Pribadi',
            'AUP' => 'Angkutan Umum Penumpang',
            'TR' => 'Truk Ringan',
            'BS' => 'Bus Sedang',
            'TS' => 'Bus Sedang',
            'BB' => 'Bus Besar',
            'TB' => 'Truk Berat',
            'Gandeng' => 'Gandeng',
            'KTB' => 'Kendaraan Tak Bermotor'
        ];

        return $mapping[$kode] ?? $kode;
    }
}
