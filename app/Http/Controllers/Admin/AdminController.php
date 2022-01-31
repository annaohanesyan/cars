<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;
use App\Models\Make;
use App\Models\Carmodel;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        
    }

    public function index()
    {
        $cars = Car::select('cars.*', 'makes.make_name', 'carmodels.model_name')
        ->leftJoin('makes', 'cars.make_id', '=', 'makes.id')
        ->leftJoin('carmodels', 'cars.model_id', '=', 'carmodels.id')
        ->get();
        
    
        return view('admin.admin', compact('cars'));
    }


}
