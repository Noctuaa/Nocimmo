<?php

namespace App\Http\Controllers;

use App\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EquipmentController extends Controller
{

    public function __construct()
    {   
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipment =  Equipment::select('name', 'id')->get();
        return view('immo.equipment', compact('equipment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
        ]);

        $equipment = $request->only('name');
        $equipment['name'] = Str::ucfirst($equipment['name']);
        Equipment::create($equipment);
        return redirect(action('EquipmentController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipment = Equipment::FindOrFail($id);    
        $equipment->delete();
        return redirect(action('EquipmentController@index'));
    }
}
