<?php

// namespace App\Livewire;

// use Livewire\Component;

// class PerbandinganKendaraan extends Component
// {
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

//     public $jenisKendaraan = [
//         ['name' => 'Motor', 'masuk' => -4, 'keluar' => 9],
//         ['name' => 'Mobil', 'masuk' => -3, 'keluar' => 7],
//         ['name' => 'Bus', 'masuk' => -2, 'keluar' => 5],
//         ['name' => 'Truk', 'masuk' => -1, 'keluar' => 3],
//     ];

//     public function render()
//     {
//         return view('livewire.perbandingan-kendaraan');
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

    protected $listeners = ['updateFilter' => 'setFilter'];

    public function mount()
    {
        $this->fetchData();
    }

    public function setFilter($filter)
    {
        $this->selectedFilter = $filter;
        $this->fetchData(); // Update data setelah filter berubah
    }

    public function fetchData()
    {
        $waktuFilter = match ($this->selectedFilter) {
            'hari' => "DATE(waktu) = CURDATE()",
            'bulan' => "YEAR(waktu) = YEAR(CURDATE()) AND MONTH(waktu) = MONTH(CURDATE())",
            'tahun' => "YEAR(waktu) = YEAR(CURDATE())",
            default => "1 = 1", // Jika tidak ada filter yang cocok, ambil semua data
        };

        $data = DB::select("
            WITH kendaraan_masuk AS (
                SELECT 'barat' AS asal, COUNT(*) AS total_masuk FROM arus_lalu_lintas_barat_detailed WHERE $waktuFilter
                UNION ALL
                SELECT 'timur' AS asal, COUNT(*) AS total_masuk FROM arus_lalu_lintas_timur_detailed WHERE $waktuFilter
                UNION ALL
                SELECT 'utara' AS asal, COUNT(*) AS total_masuk FROM arus_lalu_lintas_utara_detailed WHERE $waktuFilter
                UNION ALL
                SELECT 'selatan' AS asal, COUNT(*) AS total_masuk FROM arus_lalu_lintas_selatan_detailed WHERE $waktuFilter
            ),
            kendaraan_keluar AS (
                SELECT 'barat' AS asal, COUNT(*) AS total_keluar FROM arus_lalu_lintas_barat_detailed WHERE $waktuFilter AND arah IS NOT NULL AND arah != 'barat'
                UNION ALL
                SELECT 'timur' AS asal, COUNT(*) AS total_keluar FROM arus_lalu_lintas_timur_detailed WHERE $waktuFilter AND arah IS NOT NULL AND arah != 'timur'
                UNION ALL
                SELECT 'utara' AS asal, COUNT(*) AS total_keluar FROM arus_lalu_lintas_utara_detailed WHERE $waktuFilter AND arah IS NOT NULL AND arah != 'utara'
                UNION ALL
                SELECT 'selatan' AS asal, COUNT(*) AS total_keluar FROM arus_lalu_lintas_selatan_detailed WHERE $waktuFilter AND arah IS NOT NULL AND arah != 'selatan'
            )
            SELECT km.asal, km.total_masuk, COALESCE(kk.total_keluar, 0) AS total_keluar
            FROM kendaraan_masuk km
            LEFT JOIN kendaraan_keluar kk ON km.asal = kk.asal;
        ");

        $this->jenisKendaraan = collect($data)->map(function ($item) {
            return [
                'name' => ucfirst($item->asal),
                'masuk' => -$item->total_masuk, // Masuk dibuat negatif untuk visualisasi Highcharts
                'keluar' => $item->total_keluar,
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.perbandingan-kendaraan');
    }
}
