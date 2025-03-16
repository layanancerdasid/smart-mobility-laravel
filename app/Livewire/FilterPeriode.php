<?php

namespace App\Livewire;

use Livewire\Component;

class FilterPeriode extends Component
{
    public $selectedFilter = 'hari';

    public function setFilter($filter)
    {
        $this->selectedFilter = $filter;
        $this->dispatch('updateFilter', filter: $filter); // Emit event dengan dispatch
    }

    public function render()
    {
        return view('livewire.filter-periode');
    }
}
