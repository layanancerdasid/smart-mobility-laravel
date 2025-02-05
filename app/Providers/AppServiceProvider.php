<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\Breadcrumbs;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Blade::component('breadcrumbs', Breadcrumbs::class);
    }
}
