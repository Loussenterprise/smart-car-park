<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarController;


Route::get('/cars', [CarController::class, 'listing'])->name('listing');

Route::get('/profile', function () {
    return view('dashboard');
})->middleware('verified');


