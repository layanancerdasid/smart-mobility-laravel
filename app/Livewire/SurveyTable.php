<?php
namespace App\Livewire;

use Livewire\Component;

class SurveyTable extends Component
{
    public $periode = 'Pagi';
    public $interval = '15 menit';
    public $data = [];

    public function hydrate()
    {
        $this->generateData();
    }

    public function generateData()
    {
        dd($this->periode, $this->interval);
        $this->data = [];

        $periodeWaktu = [
            'Pagi' => ['start' => '06:00', 'end' => '12:00'],
            'Siang' => ['start' => '12:00', 'end' => '18:00'],
            'Sore' => ['start' => '18:00', 'end' => '00:00'],
            'Malam' => ['start' => '00:00', 'end' => '06:00'],
        ];

        if (!isset($periodeWaktu[$this->periode])) {
            $this->periode = 'Pagi';
        }

        $start = $periodeWaktu[$this->periode]['start'];
        $end = $periodeWaktu[$this->periode]['end'];

        $intervalMinutes = match ($this->interval) {
            '5 menit' => 5,
            '10 menit' => 10,
            '15 menit' => 15,
            'Jam' => 60,
            'Semua' => 60,
            default => 15,
        };

        $current = strtotime($start);
        $endTime = strtotime($end);

        while ($current < $endTime) {
            $next = strtotime("+{$intervalMinutes} minutes", $current);
            $this->data[] = [
                'periode' => $this->periode,
                'waktu' => date('H:i', $current) . ' - ' . date('H:i', $next),
                'sm' => rand(0, 10),
                'ks' => rand(0, 10),
                'kb' => rand(0, 10),
                'ktb' => rand(0, 10),
            ];
            $current = $next;
        }

        dd($this->data);
    }

    public function render()
    {
        return view('livewire.survey-table');
    }
}
