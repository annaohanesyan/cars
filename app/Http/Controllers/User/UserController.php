<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Car;
use App\Models\Make;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        $count = 1;
        
        $cars = Car::getPublishedCars();
        $makes = Make::getConfirmedMakes();
        return view('user.user', compact([ 'cars', 'count', 'makes']));
    }

    public function filterCars(Request $request){

        $make = $request->get('make');
        $model = $request->get('model');
        
        $filterData = User::getFilteredData($make, $model);
        
        return response()->json(['filterData'=>$filterData, 'success'=>'success']);
        
    }
}
