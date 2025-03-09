<?php
namespace App\Livewire;

use Livewire\Component;

class SurveySummary extends Component
{
    public $surveyData = [
        "Cuaca" => "Cerah Berawan",
        "Metode Survei" => "Pencacahan Lalu Lintas (Volume Kendaraan)",
        "Lokasi" => "Simpang Condongcatur (koordinat)",
        "Kabupaten/Kota" => "Sleman",
        "Kecamatan" => "Depok",
        "Lebar Jalur" => "7 meter",
        "Jumlah Lajur" => "2 lajur",
        "Median" => "Ada / Tanpa",
        "Belok Kiri Jalan Terus" => "Ya / Tidak",
        "Hambatan Samping" => "Tinggi / Sedang / Rendah",
    ];

    public function render()
    {
        return view('livewire.survey-summary', [
            'surveyData' => $this->surveyData
        ]);
    }
}
