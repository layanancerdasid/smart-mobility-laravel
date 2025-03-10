<?php
namespace App\Livewire;

use Livewire\Component;

class SurveyFilters extends Component
{
    public $surveyor = "Semua";
    public $interval = "15 menit";
    public $pendekat = "Utara";
    public $arah = "Kanan";
    public $klasifikasi = "Tipikal";

    public function downloadData()
    {
        // Logika untuk mengunduh data survei
        session()->flash('message', 'Data berhasil diunduh!');
    }

    public function render()
    {
        return view('livewire.survey-filters');
    }

    public function updated($property, $value)
    {
        $this->dispatch('refreshSurveyTable', $this->interval); // Paksa SurveyTable untuk refresh
    }
}
