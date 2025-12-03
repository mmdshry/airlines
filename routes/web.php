<?php

use App\Http\Controllers\AirplaneController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PassengerController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::resource('airplanes', AirplaneController::class);

Route::resource('contracts', ContractController::class);

Route::resource('events', EventController::class);

Route::resource('passengers', PassengerController::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::post('/passengers/reserve', [PassengerController::class, 'storeReservation'])->name('passengers.reserve');
Route::post('/passengers/reserves', [PassengerController::class, 'storeReservation'])->name('passengers.reserve.store');

Route::resource('routes', RouteController::class);
Route::patch('/routes/{route}/approve', [RouteController::class, 'approve'])->name('routes.approve');
Route::patch('/routes/{route}/reject', [RouteController::class, 'reject'])->name('routes.reject');

Route::get('/flights', [FlightController::class, 'index'])->name('flights.index');

require __DIR__.'/auth.php';
