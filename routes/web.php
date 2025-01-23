<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('profile', [\App\Http\Controllers\DataController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('profile');

Route::get('/user/{username}', [\App\Http\Controllers\ProfileController::class, 'index'])
    ->name('Data');

Route::get('data', [DataController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('data');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
