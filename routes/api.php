<?php

use App\Livewire\Pages\Dashboard;
use App\Livewire\Pages\Login;
use Illuminate\Support\Facades\Route;

Route::post('/login', [Login::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index']);
});