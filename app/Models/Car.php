<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'make_id',
        'model_id',
        'image',
        'public'
    ];

    public function getPublishedCars(){
        $cars = Car::select('cars.*', 'makes.make_name', 'carmodels.model_name')
        ->leftJoin('makes', 'cars.make_id', '=', 'makes.id')
        ->leftJoin('carmodels', 'cars.model_id', '=', 'carmodels.id')
        ->where('public', '=', 1)
        ->get();

        return $cars;
    }

}
