<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Car;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Location;

class CarController extends Controller
{
    //
    public function listing(){
        $cars=Car::orderBy('id','desc')->orderBy('popularite','desc')->take(30)->get();
        dd($cars);
        return view('Cars/listing',['cars'=>$cars]);
    }

    public function create(){
        return Inertia::render('Cars/Create');
    }

    public function show(int $id=0){
        $car=Car::find($id);
        if($car==null){
            return redirect()->back();
        }
        return Inertia::render('Cars/Show',[
            'car'=>$car,
            'locations'=>Auth::user()!=null&&Auth::user()->is_admin==1?Location::with('user')->where('car_id',$car->id)->orderBy('updated_at','DESC')->get():null,
        ]);
    }

    public function delete(int $id=0){
        $car=Car::find($id);
        $car->delete();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function showCar(Car $car=null,Request $r){
        dump($r);
        dd($car);
        return Inertia::render('Cars/Show',['car'=>$car]);
    }

    public function showOther(){
        return Inertia::render('Cars/Show',['car'=>new Car()]);
    }


    public function store(Request $request){
        $car = new Car();
        $car->name=$request->name;
        $car->nbrsiege=$request->nbrsiege;
        $car->nbrroue=$request->nbrroue;
        $car->width=$request->width;
        $car->length=$request->length;
        $car->height=$request->height;
        $car->prix=$request->prix;
        $car->consombyhr=$request->consombyhr;
        $car->save();

        // GESTION DE IMAGE

        // if($request->hasfile('image')){
        //     $file=$request->file('image');
        //     $ext=$file->getClientOriginalExtension();
        //     $filename = time().'.car_'.$car->id.'.'.$ext;
        //     $file->move('uploads/car/img',$filename);
        //     $car->image = $filename;
        //     $car->save();
        //     dd($car->image);
        // }
        if($request->hasfile('image')) {
            $file_name = time().'.car_'.$car->id.'.'.$request->file('image')->getClientOriginalName();
            $file_path = $request->file('image')->storeAs('uploads', $file_name, 'public');
            $car->image = asset('storage/' . $file_path);
            $car->save();
        }
        return redirect()->route('car.show',['id'=>$car->id]);
    }

    public function update(int $id=0,Request $request){
        $car=Car::find($id);
        $car->name=$request->name;
        $car->nbrsiege=$request->nbrsiege;
        $car->nbrroue=$request->nbrroue;
        $car->width=$request->width;
        $car->length=$request->length;
        $car->height=$request->height;
        $car->prix=$request->prix;
        $car->consombyhr=$request->consombyhr;
        $car->save();
        return redirect()->route('car.show',['id'=>$car->id]);
    }
}
