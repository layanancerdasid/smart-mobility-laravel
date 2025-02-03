<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Dashboard extends Component
{
    public $stats = [
        'users' => 1234,
        'products' => 567,
        'sales' => 12345
    ];

    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
