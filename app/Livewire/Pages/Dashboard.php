<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Dashboard extends Component
{
    public $stats = [];

    public function mount()
    {
        $this->generateRandomStats();
    }

    public function generateRandomStats()
    {
        $this->stats = [
            'vehicles' => rand(800, 2500), // Total kendaraan dalam rentang masuk akal
            'congestion' => rand(10, 80), // Kemacetan dalam persentase
            'average_delay' => rand(5, 60) // Keterlambatan dalam menit
        ];
    }

    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
