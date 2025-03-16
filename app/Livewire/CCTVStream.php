<?php

namespace App\Livewire;

use Livewire\Component;

class CCTVStream extends Component
{
    public $imageUrl = ''; // URL gambar CCTV
    public $vehicleCount = 0; // Jumlah kendaraan terdeteksi
    public $detections = []; // Data kendaraan (arah, jenis, dll.)

    protected $listeners = ['updateCCTV' => 'updateStream'];

    public function updateStream($data)
    {
        $this->imageUrl = $data['image_url'];
        $this->vehicleCount = $data['count'];
        $this->detections = $data['detections'];
    }

    public function render()
    {
        return view('livewire.cctv-stream');
    }
}
