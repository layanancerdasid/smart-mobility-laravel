<?php
namespace App\Livewire;

use Livewire\Component;

class SurveyFilters extends Component
{
    public $surveyor = "";
    public $interval = "15 menit";
    public $pendekat = "";
    public $arah = "";
    public $klasifikasi = "";
    public $periode = 'Pagi'; // Default periode

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
        \Log::info("SurveyFilters Updated: {$property} -> {$value}");
    
        if ($property === 'periode' || $property === 'interval') {
            $this->dispatch('refreshSurveyTable', $this->periode, $this->interval); // Paksa SurveyTable untuk refresh
        }
    }
    
}
