<?php

namespace App\Livewire;

use Livewire\Component;

class Maps extends Component
{
    public $vehicleCounts = [
        'north' => ['in' => 0, 'out' => 0],
        'south' => ['in' => 0, 'out' => 0],
        'east' => ['in' => 0, 'out' => 0],
        'west' => ['in' => 0, 'out' => 0]
    ];

    public $thresholds = [
        'low' => 20,
        'medium' => 40
    ];

    public function updateThresholds($low, $medium)
    {
        $this->thresholds['low'] = max(0, intval($low));
        $this->thresholds['medium'] = max($this->thresholds['low'] + 1, intval($medium));

        // Dispatch threshold update event
        $this->dispatch('thresholds-updated', $this->thresholds);

        // Update all directions with new thresholds
        $this->updateAllDirections();
    }

    public function updateAllDirections()
    {
        foreach ($this->vehicleCounts as $direction => $counts) {
            $totalCount = $counts['in'] + $counts['out'];

            // Determine traffic level
            $level = 'low';
            if ($totalCount > $this->thresholds['medium']) {
                $level = 'high';
            } elseif ($totalCount > $this->thresholds['low']) {
                $level = 'medium';
            }

            // Dispatch update event
            $this->dispatch('traffic-updated', [
                'direction' => $direction,
                'level' => $level,
                'count' => $totalCount
            ]);
        }
    }

    public function updateVehicleCount($direction, $type, $count)
    {
        $this->vehicleCounts[$direction][$type] = max(0, intval($count));

        // Calculate total vehicles for this direction
        $totalCount = $this->vehicleCounts[$direction]['in'] + $this->vehicleCounts[$direction]['out'];

        // Determine traffic level based on total count
        $level = 'low';
        if ($totalCount > $this->thresholds['medium']) { // > 40
            $level = 'high';
        } elseif ($totalCount > $this->thresholds['low']) { // > 20
            $level = 'medium';
        }

        // Debug logging
        \Log::info("Traffic Update", [
            'direction' => $direction,
            'total_count' => $totalCount,
            'level' => $level,
            'thresholds' => $this->thresholds
        ]);

        $this->dispatch('traffic-updated', [
            'direction' => $direction,
            'type' => $type,
            'level' => $level,
            'count' => $totalCount
        ]);
    }

    public function render()
    {
        return view('livewire.maps')
            ->title('3D Map Kota Bandung');
    }
}
