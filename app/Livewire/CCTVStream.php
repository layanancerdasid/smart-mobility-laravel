<?php

namespace App\Livewire;

use Livewire\Component;

class CctvStream extends Component
{
    public $imageUrl = '';
    public $imageUrl1 = '';
    public $imageUrl2 = '';
    public $imageUrl3 = '';
    public $imageUrl4 = '';
    public $imageUrl5 = '';    
    public $vehicleCount = 0;
    public $vehicleCount1 = 0;
    public $vehicleCount2 = 0;
    public $vehicleCount3 = 0;
    public $vehicleCount4 = 0;
    public $vehicleCount5 = 0;
    public $detections = [];
    public $detections1 = [];
    public $detections2 = [];
    public $detections3 = [];
    public $detections4 = [];
    public $detections5 = [];
    public $selectedFilter = 'hari';

    public function setFilter($filter)
    {
        $this->selectedFilter = $filter;
    }

    public function updateStream($data)
    {
        // \Log::info("📡 Livewire menerima updateCCTV", $data);

        // if (!isset($data['image_url']) || !isset($data['count']) || !isset($data['detections'])) {
        //     // \Log::error("❌ Format data tidak sesuai", $data);
        //     return;
        // }

        if (!isset($data['image_url']) || !isset($data['count']) || !isset($data['detections']) || !isset($data['room_id'])) {
            return;
        }

        // \Log::info("🛠️ updateStream dipanggil", $data);
        switch ($data['room_id']) {
            // case 'result_detection':
            //     $this->imageUrl1 = $data['image_url'];
            //     foreach ($data['detections'] as $detection) {
            //         array_unshift($this->detections1, $detection);
            //     }
            //     $this->detections1 = array_slice($this->detections1, 0, 100);
            //     break;
            case 'result_detection_2':
                $this->imageUrl2 = $data['image_url'];
                foreach ($data['detections'] as $detection) {
                    array_unshift($this->detections2, $detection);
                }
                $this->detections2 = array_slice($this->detections2, 0, 100);
                break;
            case 'result_detection_3':
                $this->imageUrl3 = $data['image_url'];
                foreach ($data['detections'] as $detection) {
                    array_unshift($this->detections3, $detection);
                }
                $this->detections3 = array_slice($this->detections3, 0, 100);
                break;
            case 'result_detection_4':
                $this->imageUrl4 = $data['image_url'];
                foreach ($data['detections'] as $detection) {
                    array_unshift($this->detections4, $detection);
                }
                $this->detections4 = array_slice($this->detections4, 0, 100);
                break;
            case 'result_detection_5':
                $this->imageUrl5 = $data['image_url'];
                foreach ($data['detections'] as $detection) {
                    array_unshift($this->detections5, $detection);
                }
                $this->detections5 = array_slice($this->detections5, 0, 100);
                break;
        }

        // $this->imageUrl = $data['image_url'];
        // $this->vehicleCount = $data['count'];

        // ✅ Append data baru ke awal array, batasi hanya 100 entri terakhir
        // foreach ($data['detections'] as $detection) {
        //     array_unshift($this->detections, $detection);
        // }
        // $this->detections = array_slice($this->detections, 0, 100);
    }

    public function render()
    {
        return view('livewire.cctv-stream');
    }
}
