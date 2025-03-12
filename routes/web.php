<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Dashboard;
use App\Livewire\Cameras;
use App\Livewire\Trafics;
use App\Livewire\Congestions;
use App\Livewire\Intersections;
use App\Livewire\Login;
use App\Livewire\Traveltimes;
use App\Livewire\Settings;
use App\Livewire\Simulations;
use App\Livewire\Maps;
use App\Models\Intersection;
use App\Livewire\SurveyPage;
// use App\Livewire\Dashboard;
use App\Http\Controllers\IntersectionController;

// Public routes
Route::get('/', function () {
    return view('components.layouts.landing');
});

// Authentication routes
Route::get('/login', Login::class)->name('login');
Route::get('/auth/sso', [Login::class, 'loginWithSSO'])->name('sso.login');
Route::get('/auth/callback', [Login::class, 'handleSSOCallback'])->name('sso.callback');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [Login::class, 'destroy'])->name('logout');
    Route::get('/maps', Maps::class)->name('maps');
});
// Route::get('/dashboard', Dashboard::class)->name('dashboard-legacy');
Route::get('/intersections', Intersections::class)->name('intersections');
Route::get('/cameras', Cameras::class)->name('cameras');
Route::get('/traffic-flow', Trafics::class)->name('traffic-flow');
Route::get('/congestions', Congestions::class)->name('congestions');
Route::get('/travel-times', Traveltimes::class)->name('travel-times');
Route::get('/settings', Settings::class)->name('settings');
Route::get('/simulations', Simulations::class)->name('simulations');


Route::get('/tutorial/intersections', [IntersectionController::class, 'tutorial'])->name('tutorial');
Route::get('/simulations/intersections', [IntersectionController::class, 'simulator'])->name('simulator');
Route::get('/simulations/intersections-check', [IntersectionController::class, 'check'])->name('check');


Route::get('/survey', SurveyPage::class)->name('survey');
Route::get('/dashboard', Dashboard::class)->name('dashboard');