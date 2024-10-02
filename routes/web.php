<?php

use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FlightController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::resource('airplanes', AirplaneController::class);

Route::resource('contracts', ContractController::class);

Route::resource('events', EventController::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');



require __DIR__.'/auth.php';
