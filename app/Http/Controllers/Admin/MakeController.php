<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Make;

class MakeController extends Controller
{
    public function index()
    {
        $makes = Make::all()->sortByDesc('confirmed', 0);
        return view('admin.make.index', compact('makes'));
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'make_name' => 'required|unique:makes|max:255',
            'country' => 'required|max:255',
        ]);

        Make::create([
            'make_name' => $request->get('make_name'),
            'country' => $request->get('country'),
            'confirmed' => '1',
        ]);

        return redirect()->back()
        ->with('success', 'Make created successfully.');

    }

    public function updateModalData(Request $request)
    {
        $id = $request->get('id');
        $update['make_name'] = $request->get('make_name');
        $update['country'] = $request->get('country');
       
        
        Make::where('id',$id)->update($update); 
        
        return redirect()->route('make.index')
        ->with('success', 'Make updated successfully');
    }


    public function destroy($makeId)
    {
        Make::destroy($makeId);
    
        return redirect()->route('make.index')
            ->with('success', 'Make deleted successfully');
    }

    public function confirm(Request $request){
        $confirm = $request->confirm;
        $id = $request->id;

        if($confirm == 0){
            $update['confirmed'] = 1;
            $data = Make::where('id',$id)->update($update);
        }else{
            $update['confirmed'] = 0;
            $data = Make::where('id',$id)->update($update);
        }

        return response()->json(['data'=>$data, 'success'=>'Make confirmed']);
    }




}
