<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    //
    public function listing(){
        $cars=Car::orderBy('popularite','desc')->take(30)->get();
        dd($cars);
        return view('Cars/listing',['cars'=>$cars]);
    }
}
