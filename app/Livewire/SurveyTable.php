<?php
namespace App\Livewire;

use Livewire\Component;

class SurveyTable extends Component
{
    public $periode = 'Pagi';
    public $interval = '15 menit';
    public $data = [];

    protected $listeners = ['refreshSurveyTable' => 'updateData'];

    public function hydrate()
    {
        $this->generateData();
    }

    // public function generateData()
    // {
    //     \Log::info("Generate data dipanggil dengan Periode: {$this->periode} dan Interval: {$this->interval}");
    
    //     $this->data = [];
    
    //     $periodeWaktu = [
    //         'Pagi' => ['start' => '06:00', 'end' => '12:00'],
    //         'Siang' => ['start' => '12:00', 'end' => '18:00'],
    //         'Sore' => ['start' => '18:00', 'end' => '00:00'],
    //         'Malam' => ['start' => '00:00', 'end' => '06:00'],
    //     ];
    
    //     if (!isset($periodeWaktu[$this->periode])) {
    //         $this->periode = 'Pagi';
    //     }
    
    //     $start = $periodeWaktu[$this->periode]['start'];
    //     $end = $periodeWaktu[$this->periode]['end'];
    
    //     $intervalMinutes = match ($this->interval) {
    //         '5 menit' => 5,
    //         '10 menit' => 10,
    //         '15 menit' => 15,
    //         'Jam' => 60,
    //         'Semua' => 60,
    //         default => 15,
    //     };
    
    //     $current = strtotime($start);
    //     $endTime = strtotime($end);
    
    //     while ($current < $endTime) {
    //         $next = strtotime("+{$intervalMinutes} minutes", $current);
    //         $this->data[] = [
    //             'periode' => $this->periode,
    //             'waktu' => date('H:i', $current) . ' - ' . date('H:i', $next),
    //             'sm' => rand(0, 10),
    //             'ks' => rand(0, 10),
    //             'kb' => rand(0, 10),
    //             'ktb' => rand(0, 10),
    //         ];
    //         $current = $next;
    //     }
    
    //     \Log::info("Data yang dihasilkan:", $this->data);
    // }

    public function generateData()
    {
        \Log::info("Generate data dipanggil dengan Interval: {$this->interval}");
    
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
    
            $currentTime = $endTime;
        }
    
        \Log::info("Data yang dihasilkan:", $this->data);
    }

    public function render()
    {
        \Log::info("SurveyTable Render: Periode -> {$this->periode}, Interval -> {$this->interval}");
        return view('livewire.survey-table', [
            'data' => $this->generateData(),
        ]);
    }

    public function refreshTable()
    {
        \Log::info("SurveyTable refreshTable() dipanggil");
        $this->generateData();
    }

    public function mount($periode = 'Pagi', $interval = '15 menit')
    {
        $this->periode = $periode;
        $this->interval = $interval;
        \Log::info("SurveyTable Mounted: Periode -> {$this->periode}, Interval -> {$this->interval}");
        $this->generateData();
    }
    
    public function updated($property, $value)
    {
        \Log::info("SurveyTable Updated: {$property} -> {$value}");
    
        if ($property === 'periode' || $property === 'interval') {
            \Log::info("Sebelum generateData: Periode -> {$this->periode}, Interval -> {$this->interval}");
            $this->generateData();
        }
    }
    
    public function updateData($periode, $interval)
    {
        \Log::info("SurveyTable menerima event: Periode -> {$periode}, Interval -> {$interval}");
    
        $this->periode = $periode;
        $this->interval = $interval;
        $this->generateData();
    }
}
