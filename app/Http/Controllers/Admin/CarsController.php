<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Make;
use App\Models\Carmodel;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $makes = Make::getConfirmedMakes();
        return view('admin.cars.index', compact('makes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $car = new Car();

        $request->validate([
            'make_id'  => 'required',
            'model_id' => 'required',
        ]);
 
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();  

            $request->image->storeAs('images', $imageName);
            
            request()->image->move(public_path('images'), $imageName);


            Car::create([
                'make_id' => $request->get('make_id'),
                'model_id' => $request->get('model_id'),
                'image' => $imageName,
            ]);

        }else{
            Car::create([
                'make_id' => $request->get('make_id'),
                'model_id' => $request->get('model_id'),
            ]);
          }
        
          return redirect()->back()
            ->with('success', 'Car created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $makes = Make::all();
        $car = Car::select('cars.*', 'carmodels.model_name')
        ->leftJoin('carmodels', 'carmodels.id', '=', 'cars.model_id') 
        ->where('cars.id', $id)
        ->first();
       
        return view('admin.cars.edit', compact(['makes', 'car']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'make_id' => 'required',
            'model_id' => 'required',
            // 'image' => 'required',
        ]);

        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();  
            $request->image->storeAs('images', $imageName);
            request()->image->move(public_path('images'), $imageName);

            $update['make_id'] = $request->get('make_id');
            $update['model_id'] = $request->get('model_id');
            $update['image'] = $imageName;
           
            Car::where('id',$id)->update($update);
        }else{
            $update['make_id'] = $request->get('make_id');
            $update['model_id'] = $request->get('model_id');
           
            Car::where('id',$id)->update($update);  
        }

        return redirect()->back()
            ->with('success', 'Car updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Car::destroy($id);
    
        return redirect()->route('admin')
            ->with('success', 'Make deleted successfully');
    }

    public function getcarmodels(Request $request){
        
        $id = number_format($request->get('id'));
        $car_model = Make::find($id)->carmodels;

        return $car_model;
        
    }

    public function publish(Request $request){
        $public = $request->public;
        $id = $request->id;

        if($public == 0){
            $update['public'] = 1;
            $data = Car::where('id',$id)->update($update);
        }else{
            $update['public'] = 0;
            $data = Car::where('id',$id)->update($update);
        }
        return response()->json(['data'=>$data, 'success'=>'Car successfully added on published']);
    }

   
}
