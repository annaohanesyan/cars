<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'make_name',
        'country',
        'confirmed'
    ];

    public function carmodels() {
        return $this->hasMany(Carmodel::class);
    }

    public function getConfirmedMakes(){
        return Make::where('confirmed', 1)->get();
    }

}
