<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin() {
        return $this->role === 'admin';
    }
 
    public function isUser() {
        return $this->role === 'user';
    }

    public function getFilteredData($make_name, $model_name = null){

        $data = Car::select('cars.*', 'makes.make_name', 'carmodels.model_name')
        ->leftJoin('makes', 'cars.make_id', '=', 'makes.id')
        ->leftJoin('carmodels', 'cars.model_id', '=', 'carmodels.id')
        ->where('makes.make_name', 'like', '%'.$make_name.'%');

        if(isset($model_name)) {
            $data = $data->where('carmodels.model_name', 'like', '%'.$model_name.'%');
        }
   
        $data = $data->where('public', '=', 1);
        $data = $data->get();
        
        return $data;
    }
}
