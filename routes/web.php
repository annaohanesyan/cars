<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\MakeController;
use App\Http\Controllers\Admin\ModelController;
use App\Http\Controllers\Admin\CarsController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\CarModelsController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('locale/{locale}', function($locale){
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/collection', [App\Http\Controllers\HomeController::class, 'getcollection'])->name('collection');

Auth::routes();

//user page
Route::group(['middleware' => ['auth', 'user'], 'prefix' => 'user'], function () {
    Route::get('/', [App\Http\Controllers\User\UserController::class, 'index'])->name('user');
    Route::post('filter', [App\Http\Controllers\User\UserController::class, 'filterCars'])->name('filter');
    Route::resource('carsmakes', App\Http\Controllers\User\CarMakesController::class);
    Route::resource('carsmodels', App\Http\Controllers\User\CarModelsController::class);
    Route::post('cars/carmodels', [App\Http\Controllers\Admin\CarsController::class, 'getcarmodels'])->name('carmodels');
});


// admin page
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/',  [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');

    Route::resource('make', App\Http\Controllers\Admin\MakeController::class);
    Route::post('make/updatemake', [App\Http\Controllers\Admin\MakeController::class, 'updateModalData'])->name('updatemake');
    Route::post('make/confirm', [App\Http\Controllers\Admin\MakeController::class, 'confirm'])->name('confirmMake');

    Route::resource('model', App\Http\Controllers\Admin\ModelController::class);
    Route::post('model/confirm', [App\Http\Controllers\Admin\ModelController::class, 'confirm'])->name('confirmModel');
    Route::post('model/getmodel', [App\Http\Controllers\Admin\ModelController::class, 'getModelByMark'])->name('getModelByMark');

    Route::resource('cars', App\Http\Controllers\Admin\CarsController::class);
    Route::post('cars/public', [App\Http\Controllers\Admin\CarsController::class, 'publish'])->name('public');
   
});



