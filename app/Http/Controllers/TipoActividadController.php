<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoActividad;

class TipoActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // if (!$request->ajax()) return redirect('/');

       $buscar = $request->buscar;
       $table=TipoActividad::all();
       return $table;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (!$request->ajax()) return redirect('/');
        $table= new TipoActividad();
        $table->tipo = $request->tipo;
        
        $table->estado= '1';
        $table->save();
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
         // if (!$request->ajax()) return redirect('/');
         $table = TipoActividad::findOrFail($request->id);
         $table->tipo = $request->tipo;
         $table->save();
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (!$request->ajax()) return redirect('/');
        $table=TipoActividad::find($id);
        $table->delete();
    }
}
