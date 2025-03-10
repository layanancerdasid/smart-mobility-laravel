<?php

// namespace App\Livewire;

// use Livewire\Component;

// class PerbandinganKendaraan extends Component
// {
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

use Livewire\Component;

class PerbandinganKendaraan extends Component
{
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

    public $jenisKendaraan = [
        ['name' => 'Motor', 'masuk' => -4, 'keluar' => 9],
        ['name' => 'Mobil', 'masuk' => -3, 'keluar' => 7],
        ['name' => 'Bus', 'masuk' => -2, 'keluar' => 5],
        ['name' => 'Truk', 'masuk' => -1, 'keluar' => 3],
    ];

    public function render()
    {
        return view('livewire.perbandingan-kendaraan');
    }
}
