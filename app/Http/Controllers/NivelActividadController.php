<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NivelActividad;

class NivelActividadController extends Controller
{
    public function select(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $table=NivelActividad::where('nombre','like','%'.$buscar.'%')
        ->get();
        return ['table' => $table];
    }
}
