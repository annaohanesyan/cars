<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carmodel;
use App\Models\Make;

class ModelController extends Controller
{
    public function index()
    {
        $makes = Make::getConfirmedMakes();
        $models = Carmodel::getModelsWithMakes()->sortByDesc('confirmed', 0);;
        
        return view('admin.model.index', compact(['makes', 'models']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'model_name' => 'required|max:255',
            'color' => 'required|max:255',
            'make_id'    => 'required|max:255',
        ]);

        Carmodel::create([
            'model_name' => $request->get('model_name'),
            'color' => $request->get('color'),
            'make_id' => $request->get('make_id'),
            'confirmed' => 1,
        ]);

        return redirect()->back()
        ->with('success', 'Make created successfully.');

    }

    public function destroy($modelId)
    {
        Carmodel::destroy($modelId);
    
        return redirect()->route('model.index')
            ->with('success', 'Car model deleted successfully');
    }

    public function confirm(Request $request){
        $confirm = $request->confirm;
        $id = $request->id;

        if($confirm == 0){
            $update['confirmed'] = 1;
            $data = Carmodel::where('id',$id)->update($update);
        }else{
            $update['confirmed'] = 0;
            $data = Carmodel::where('id',$id)->update($update);
        }
        
        return response()->json(['data'=>$data, 'success'=>'Car model confirmed']);
    }
    

    public function getModelByMark(Request $request){
        
        $id = number_format($request->get('id'));
        $car_model = Make::find($id)->carmodels;

        return $car_model;
        
    }

}
