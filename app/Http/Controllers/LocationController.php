<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Car;
use App\Models\Location;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function create(Request $req )
    {   
        $car_id=$req->input("car_id")?$req->input("car_id"):0;
        if(!is_numeric($car_id)){
            $car_id=0;
        }
            
        if($car_id==0 || $car_id=='0' )
        {
            return redirect()->route("welcome");
        }
        $car=Car::find($car_id);
        $totalprice=$car!=null?$car->prix:0;

        $token_at=Date("Y-m-d\TH:i");
        $free_at=Date("Y-m-d\TH:i", strtotime('+1 days'));
        return Inertia::render('Locations/Create',[
            'car'=>$car,
            'totalprice'=>$totalprice,
            'token_at'=>$token_at,
            'free_at'=>$free_at,
        ]);
    }

    public function store(Request $req )
    {
        $l = new Location();
        $l->user_id=$req->user_id;
        $l->car_id=$req->car_id;
        $l->token_at=$req->token_at;
        $l->duration=$req->duration;

        $c=Car::find($l->car_id);
        $c->free=false;
        $l->prix=$c->prix*$req->duration;
        $c->popularite=$c->popularite+1;
        $c->save();
        $l->save();
        return redirect()->route('dashboard');
    }

    public function close(Request $req )
    {
        $u=Auth::user();
        $id=$req->input("id")?$req->input("id"):0;
        if(is_numeric($id)){
            
            $loc=Location::find($id);
            if($loc!=null){
                if($loc->user_id==$u->id || $u->is_admin==1){
                    $loc->free_at=Date("Y-m-d\TH:i:s");
                    $loc->closed=true;
                    $car=Car::find($loc->car_id);
                    $car->free=true;
                    $car->save();
                    $loc->save();
                }else{
                    return Inertia::render('RequestError', [
                        'error'=>'You have not access to this ressource'
                    ]);
                }
            }
        }

        return redirect()->back();
    }
}