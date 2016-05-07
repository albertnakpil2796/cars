<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Car;
use App\Color;
class CarController extends Controller
{
    //
    public function index(){
    	$cars = Car::orderBy('position','desc')->get();

    	return view('cars.index')
    		   ->with('cars',$cars);

    }
    public function car_list(){
    	$cars = Car::orderBy('position','desc')->get();

    	return view('cars.table')
    		   ->with('cars',$cars);

    }
    public function filter(Request $request){
    	$id = $request->get('id');
    	if($id == 1){
    		$cars = Car::orderBy('color','asc')->get();
    	}else if($id == 2){
    		$cars = Car::orderBy('color','desc')->get();
    	}else{
				$cars = Car::all();
    	}
    	return view('cars.table')
    		   ->with('cars',$cars);

    } 

    public function store(Request $request){
    	if(count(Car::max('position')) > 0){
    	$maxPosition = Car::max('position');
    	}else{
    		$maxPosition = 0;
    	}
    	$car = new Car;
    	$car->name = $request->get('name');
    	$car->position = $maxPosition+5;
    	$car->color = $request->get('color');
    	$car->save();

    	echo "Success";
    }
    public function add(){
    	$colors = Color::all();
    	$viewOnly = 1;
    	return view('cars.form')
    		   ->with('viewOnly',$viewOnly)
    		   ->with('avail_colors',$colors);
    }

    public function view(Request $request){
    	$id = $request->get('id');
    	$car = Car::find($id);
    	$viewOnly = 2;

    	return view('cars.form')
    		   ->with('carx',$car)
    		   ->with('viewOnly',$viewOnly);
    }

    public function edit(Request $request){
    	$id = $request->get('id');
    	$minpos= Car::min('position');
    	$maxpos = Car::max('position');

    	$car = Car::find($id);
    	
    	if($minpos == $car->position){
    		$allCars = Car::where('id','!=',$id)->get();	
    		$min = true;
    		$max = false;
    	}else if($maxpos == $car->position){
    		$allCars = Car::where('id','!=',$id)->get();	
    		$min = false;
    		$max = true;
    	}else{
    		$allCars = Car::where('id','!=',$id)->get();	
    		$min = false;
    		$max = false;
    	}
    	
    	$viewOnly = 3;
    	    	return view('cars.form')
    		   ->with('care',$car)
    		   ->with('viewOnly',$viewOnly)
    		   ->with('allCars',$allCars)
    		   ->with('min',$min)
    		   ->with('max',$max);
    }

    public function destroy(Request $request){
    	$car = Car::find($request->get('id'));
    	$car->delete();
    }

    public function move($id , $inId, $first){
    	$cartobemoved = Car::find($id);
    	$carin = Car::find($inId);

    	$mark = $carin->position;

    	//move in front
    	if($first == true){
    		$newpos = $mark+1; 
    	}
    	//move in behind
    	else{

    		$newpos = $mark-1;
    	}
    	$cartobemoved->position = $newpos;
    	$cartobemoved->save();
    }
}
