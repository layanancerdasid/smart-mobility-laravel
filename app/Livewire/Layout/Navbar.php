<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Navbar extends Component
{
    public $pageTitle;
    public $breadcrumbs;

    public function mount()
    {
        // Mengatur judul halaman dan breadcrumb berdasarkan URL saat ini
        $segments = request()->segments();
        $this->pageTitle = end($segments) ? ucfirst(end($segments)) : 'Dashboard';
        
        // Membuat breadcrumbs
        $this->breadcrumbs = collect($segments)->map(function ($segment) {
            return ucfirst($segment);
        })->toArray();
    }

    public function render()
    {
        return view('livewire.layout.navbar');
    }
}