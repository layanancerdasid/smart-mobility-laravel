<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = $this->generateBreadcrumbs();
    }

    public function render()
    {
        return view('components.breadcrumbs');
    }

    protected function generateBreadcrumbs()
    {
        $breadcrumbs = [];
        $segments = request()->segments();

        // Selalu tambahkan Home sebagai item pertama
        $breadcrumbs[] = [
            'name' => 'Home',
            'url' => route('dashboard'),
            'active' => count($segments) === 0
        ];

        $path = '';
        foreach ($segments as $segment) {
            $path .= '/'.$segment;
            $breadcrumbs[] = [
                'name' => ucwords(str_replace('-', ' ', $segment)),
                'url' => url($path),
                'active' => $path === '/'.request()->path()
            ];
        }

        return $breadcrumbs;
    }
}