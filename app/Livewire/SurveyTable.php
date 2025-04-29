<?php
namespace App\Livewire;

use Livewire\Component;

class SurveyTable extends Component
{
    public $interval = '15 menit';
    public $data = [];

    protected $listeners = ['refreshSurveyTable' => 'updateData'];

    public function hydrate()
    {
        $this->generateData();
    }

    public function generateData()
    {
        // Ambil semua data berdasarkan interval
        $this->data = [];
    
        // Tentukan interval waktu
        $step = match ($this->interval) {
            '5 menit' => 5,
            '10 menit' => 10,
            '15 menit' => 15,
            'Jam' => 60,
            default => 15, // Default 15 menit jika interval tidak dikenali
        };
    
        // Iterasi dari 00:00 sampai 23:59 dan buat entri waktu
        $currentTime = strtotime('00:00');
        while ($currentTime < strtotime('24:00')) {
            $endTime = $currentTime + ($step * 60);
            $formattedTime = date('H:i', $currentTime) . ' - ' . date('H:i', $endTime);
    
            // Tentukan periode berdasarkan jam
            $hour = (int) date('H', $currentTime);
            $periode = match (true) {
                $hour >= 0 && $hour < 6 => 'Malam',
                $hour >= 6 && $hour < 12 => 'Pagi',
                $hour >= 12 && $hour < 18 => 'Siang',
                $hour >= 18 && $hour < 24 => 'Sore',
            };
    
            $this->data[] = [
                'periode' => $periode,
                'waktu' => $formattedTime,
                'sm' => rand(0, 10), // Simulasi data
                'ks' => rand(0, 10),
                'kb' => rand(0, 10),
                'ktb' => rand(0, 10),
            ];

            $this->data[] = [
                'periode' => $periode,
                'waktu' => $formattedTime,
                'sm' => 0, // Simulasi data
                'ks' => 0,
                'kb' => 0,
                'ktb' => 0,
            ];
    
            $currentTime = $endTime;
        }
    }

    public function render()
    {
        return view('livewire.survey-table', [
            'data' => $this->generateData(),
        ]);
    }

    public function refreshTable()
    {
        $this->generateData();
    }

    public function mount($interval = '15 menit')
    {
        $this->interval = $interval;
        $this->generateData();
    }
    
    public function updated($property, $value)
    {
        if ($property === 'periode' || $property === 'interval') {
            $this->generateData();
        }
    }
    
    public function updateData($interval)
    {
        $this->interval = $interval;
        $this->generateData();
    }
}
