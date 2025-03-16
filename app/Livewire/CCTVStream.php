<?php

namespace App\Livewire;

use Livewire\Component;

class CCTVStream extends Component
{
    public $imageUrl = '';
    public $vehicleCount = 0;
    public $detections = [];
    public $selectedFilter = 'hari';

    public function setFilter($filter)
    {
        $this->selectedFilter = $filter;
    }

    public function updateStream($data)
    {
        \Log::info("📡 Livewire menerima updateCCTV", $data);

        if (!isset($data['image_url']) || !isset($data['count']) || !isset($data['detections'])) {
            \Log::error("❌ Format data tidak sesuai", $data);
            return;
        }

        $this->imageUrl = $data['image_url'];
        $this->vehicleCount = $data['count'];

        // ✅ Append data baru ke awal array, batasi hanya 100 entri terakhir
        foreach ($data['detections'] as $detection) {
            array_unshift($this->detections, $detection);
        }
        $this->detections = array_slice($this->detections, 0, 100);
    }

    public function render()
    {
        return view('livewire.cctv-stream');
    }
}
