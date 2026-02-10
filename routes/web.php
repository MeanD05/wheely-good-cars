<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MyCarPdfController;

Route::get('/', [CarController::class, 'index'])->name('home');





Route::middleware('auth')->group(function () {
    Route::get('/offercar', [CarController::class, 'create'])->name('offercar'); 
    Route::post('/offercar/addcar', [CarController::class, 'create_step1'])->name('offercar.step1');
    Route::get('/offercar/addcar/{license_plate}', [CarController::class, 'create_step2'])->name('offercar.step2');
    Route::post('/offercar/st  ore', [CarController::class, 'store'])->name('offercar.store');
    Route::get('/mycars', [CarController::class, 'showmycars'])->name('cars.mycars');
    Route::delete('/mycars/{car}/delete', [CarController::class, 'destroy'])->name('cars.destroy');
    Route::get('/mycars/{car}/pdf', [MyCarPdfController::class, 'download'])->name('cars.pdf');
    
});


require __DIR__.'/auth.php';
