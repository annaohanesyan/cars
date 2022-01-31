<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carmodel extends Model
{
    use HasFactory;

    protected $fillable = [
        'make_id',
        'model_name',
        'color',
        'confirmed'
    ];

    public function makes() {
        return $this->belongsTo(Make::class, 'make_id');
    }

    public function getModelsWithMakes(){
        $models = Carmodel::select('carmodels.*', 'makes.make_name')
        ->leftJoin('makes', 'makes.id', '=', 'carmodels.make_id')
        ->get();

        return $models;

    }

}
