<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class TrafficChart extends Component
{
    public $selectedOrigin = 'all'; // Default: Semua asal kendaraan

    public function setOrigin($origin)
    {
        $this->selectedOrigin = $origin;
        $this->dispatch('updateCharts', $origin);
    }

    public function render()
    {
        return view('livewire.traffic-chart');
    }
}
