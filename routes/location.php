<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LocationController;
use Inertia\Inertia;
use App\Models\Car;


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/location/create', [LocationController::class, 'create'])->name('location.create');
    Route::get('/location/close', [LocationController::class, 'close'])->name('location.close');
    Route::post('/location/create', [LocationController::class, 'store'])->name('location.store');
});


