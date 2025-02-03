<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Sidebar extends Component
{
    public $collapsed = false;

    public function mount()
    {
        $this->collapsed = session()->get('sidebar_collapsed', false);
    }

    public function toggle()
    {
        $this->collapsed = !$this->collapsed;
        session()->put('sidebar_collapsed', $this->collapsed);
        $this->dispatch('toggle-sidebar', collapsed: $this->collapsed);
    }

    public function render()
    {
        return view('livewire.layout.sidebar');
    }
}
