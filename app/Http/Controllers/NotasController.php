<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Notas;

class NotasController extends Controller
{
    
    public function all () {
    	$notas = Notas::all();

    	return response()->json(['notas' => $notas]);
    }

    public function find ($id) {
    	$nota = Notas::find($id);

    	return response()->json(['nota' => $nota]);
    }

    public function new (Request $request) 
    {
    	$nota = new Notas;
    	$nota->nombre = $request->nombre;
    	$nota->descripcion = $request->descripcion;
    	$nota->fecha = $request->fecha;
    	$nota->is_active = true;
    	$nota->user_id = Auth::id();

    	$nota->save();

    	return response()->json(['res' => 'Done!']);
    }

    public function edit ($id, Request $request)
    {
    	$nota = Notas::find($id);

    	$nota->nombre = $request->nombre;
    	$nota->descripcion = $request->descripcion;
    	$nota->fecha = $request->fecha;

    	$nota->save();

    	return response()->json(['res' => 'Done!']);
    }

    public function delete ($id, Request $request) 
    {
    	$nota = Notas::find($id);

    	$nota->is_active = false;

    	$nota->save();

    	return response()->json(['res' => 'Done!']);
    }
}
