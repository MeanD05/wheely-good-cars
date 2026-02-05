<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/offercar', [CarController::class, 'create'])->name('offercar'); 
    Route::post('/offercar/addcar', [CarController::class, 'create_step1'])->name('offercar.step1');
    Route::get('/offercar/addcar/{license_plate}', [CarController::class, 'create_step2'])->name('offercar.step2');
    Route::post('/offercar/store', [CarController::class, 'store'])->name('offercar.store');
});

require __DIR__.'/auth.php';
