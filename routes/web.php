<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseDataController;
use App\Models\Admin;
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
    
  
    
Route::get('/l/{course_link}', [CourseDataController::class, 'index'])
    ->name('link');  

Route::get('/c/{course_link}', [CourseDataController::class, 'index'])
    ->name('course');  

Route::get('/p/{course_link}', [CourseDataController::class, 'index'])
    ->name('post');

Route::get('/user/course', [CourseController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('post');

    Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('admin');
  

Route::get('/{username}', [\App\Http\Controllers\ProfileController::class, 'index'])
    ->name('Data');
