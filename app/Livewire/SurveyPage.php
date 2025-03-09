<?php

namespace App\Livewire;

use Livewire\Component;

class SurveyPage extends Component
{
    public $overlayLayer = null; // Default tidak ada overlay

    public function updatedOverlayLayer()
    {
        $this->dispatch('addOverlayLayer', $this->overlayLayer);
    }

    public function render()
    {
        return view('livewire.survey-page');
    }
}
