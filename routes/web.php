<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Car;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $more=$request->input('more')?$request->input('more'):0;
    if(!is_numeric($more))
        $more=0;
    $cars=Car::orderBy('id','desc')->orderBy('popularite','desc')->offset($more*15)->take(15)->get();
    $count=Car::count();
    return Inertia::render('Welcome', [
        'more'=>($more+1)*15 <$count ? $more+1 : null,
        'prev'=>$more>0?$more-1:null,
        'cars'=>$cars,
        'count'=>$count,
    ]);
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $id=Auth::id();

    return Inertia::render('Dashboard',[
        'locations'=>Location::where('user_id',$id)->orderBy('updated_at','desc')->with('car')->with('user')->get(),
    ]);
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified', 'auth'])->get('/dashboard/users', function () {
    return Inertia::render('Dashboard/Users',[
        'users'=>User::all(),
    ]);
})->name('dashboard.users');
Route::middleware(['auth:sanctum', 'verified', 'auth'])->get('/dashboard/cars', function () {
    return Inertia::render('Dashboard/Cars',[
        'cars'=>Car::all(),
    ]);
})->name('dashboard.cars');

Route::middleware(['auth:sanctum', 'verified', 'auth'])->get('/dashboard/locations', function () {
    return Inertia::render('Dashboard/Locations',[
        'locations'=>Location::with('user','car')->orderBy('closed')->get(),
    ]);

    
})->name('dashboard.locations');


require __DIR__.'/car.php';
require __DIR__.'/location.php';

require __DIR__.'/auth.php';