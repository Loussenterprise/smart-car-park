<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CarController;
use Inertia\Inertia;
use App\Models\Car;


Route::get('/cars', [CarController::class, 'listing'])->name('listing');
Route::get('/cars/show/{id}', [CarController::class, 'show'])->where('id', '[0-9]+')->name('car.show');
//Route::get('/cars/show/{car}', [CarController::class, 'showCar'])->name('car.showcar');
Route::get('/cars/show/{other}', [CarController::class, 'showOther'])->where('id', '[A-Za-z]+')->name('car.showother');

Route::middleware('admin')->group(function () {

Route::get('/cars/create', [CarController::class, 'create'])->name('car.create');
Route::post('/cars/create', [CarController::class, 'store'])->name('car.store');
    Route::get('/cars/update/{id}', function(int $id=0){
        $car=Car::find($id);
        return Inertia::render('Cars/Update', [
            'car'=>$car,
        ]);
    })->name("car.update");
    Route::post('/cars/update/{id}', [CarController::class, 'update'])->name("car.perform_update");
    Route::get('/cars/delete/{id}', [CarController::class, 'delete'])->name("car.delete");

});
Route::get('/profile', function () {
    return view('dashboard');
})->middleware('verified');



