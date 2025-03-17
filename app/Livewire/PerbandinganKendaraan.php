<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PerbandinganKendaraan extends Component
{
    public $jenisKendaraan = [];
    public $selectedFilter = 'hari'; // Default filter
    public $dataArah = [];

    protected $listeners = ['updateFilter'];

    public function mount()
    {
        $this->fetchData();
        $this->fetchDistribusiData();
        
    }

    public function updateFilter($filter)
    {
        $this->selectedFilter = $filter;
        $this->fetchData(); // Update data setelah filter berubah
        $this->fetchDistribusiData();
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

    public function fetchDistribusiData()
    {
        $periode = $this->selectedFilter;
        $data = collect(DB::select("CALL get_kendaraan_breakdown(?, 2)", [$periode]));
    
        // Struktur data berdasarkan arah
        $dataArah = [];
        $lokasiMapping = [
            'Utara' => 'Tempel',
            'Timur' => 'Prambanan',
            'Selatan' => 'Piyungan',
            'Barat' => 'Glagah'
        ];
    
        // Warna untuk jenis kendaraan
        $colorMapping = [
            'SM' => '#F39C12',
            'MP' => '#2ECC71',
            'AUP' => '#3498DB',
            'TR' => '#34495E',
            'BS' => '#E74C3C',
            'TS' => '#9B59B6',
            'BB' => '#1ABC9C',
            'TB' => '#D35400',
            'Gandeng' => '#8E44AD',
            'KTB' => '#8E44AD'
        ];
    
        // Hitung total kendaraan masuk dan keluar untuk Selatan
        $totalMasukSelatan = $data->sum('total_kendaraan');
        $totalKeluarSelatan = $totalMasukSelatan;
    
        // Buat data kendaraan untuk Selatan berdasarkan hasil query
        $jenisSelatan = [];
        foreach ($colorMapping as $kode => $color) {
            $item = $data->firstWhere('jenis_kendaraan', $kode);
            $totalKendaraan = $item->total_kendaraan ?? 0;
    
            $jenisSelatan[] = [
                'name' => $kode,
                'masuk' => $totalKendaraan,
                'keluar' => $totalKendaraan,
                'color' => $color
            ];
        }
    
        // Bangun struktur data untuk semua arah
        foreach ($lokasiMapping as $arah => $lokasi) {
            if ($arah === 'Timur') {
                // Masukkan data Selatan yang asli
                $dataArah[] = [
                    'arah' => $arah,
                    'lokasi' => $lokasi,
                    'totalMasuk' => $totalMasukSelatan,
                    'totalKeluar' => $totalKeluarSelatan,
                    'jenis' => $jenisSelatan
                ];
            } else {
                // Set semua data menjadi 0 untuk arah selain Selatan
                $jenisKosong = [];
                foreach ($colorMapping as $kode => $color) {
                    $jenisKosong[] = [
                        'name' => $kode,
                        'masuk' => 0,
                        'keluar' => 0,
                        'color' => $color
                    ];
                }
    
                $dataArah[] = [
                    'arah' => $arah,
                    'lokasi' => $lokasi,
                    'totalMasuk' => 0,
                    'totalKeluar' => 0,
                    'jenis' => $jenisKosong
                ];
            }
        }
    
        $this->dataArah = $dataArah;
        // 🔥 Dispatch event ke Alpine.js
        $this->dispatch('updateChartDistribusi', detail: $dataArah);
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
