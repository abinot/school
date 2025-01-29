<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('profile', [\App\Http\Controllers\DataController::class, 'index'])
//     ->middleware(['auth', 'verified'])
//     ->name('profile');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/user/data', [DataController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('data');
    
    
Route::get('/user/course', [CourseController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('course');    

Route::get('/{username}', [\App\Http\Controllers\ProfileController::class, 'index'])
    ->name('Data');
