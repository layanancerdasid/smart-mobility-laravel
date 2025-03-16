<?php

namespace App\Livewire;

use Livewire\Component;

class FilterPeriode extends Component
{
    public $selectedFilter = 'hari';

    public function setFilter($filter)
    {
        $this->selectedFilter = $filter;
        $this->emit('updateFilter', $filter); // Emit event ke komponen lain
    }

    public function render()
    {
        return view('livewire.filter-periode');
    }
}
