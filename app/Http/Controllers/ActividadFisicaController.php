<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActividadFisica;

class ActividadFisicaController extends Controller
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
        $table=ActividadFisica::where('nombre','like','%'.$buscar.'%')
        ->orderBy('id','desc')->paginate(10);
        return [
            'pagination' => [
                'total'        => $table->total(),
                'current_page' => $table->currentPage(),
                'per_page'     => $table->perPage(),
                'last_page'    => $table->lastPage(),
                'from'         => $table->firstItem(),
                'to'           => $table->lastItem(),
            ],
            'table' => $table
        ];
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
         // if (!$request->ajax()) return redirect('/');
        $table= new ActividadFisica();
        $table->id_tipo = $request->id_tipo;
        $table->nombre = $request->nombre;
        $table->descripcion = $request->descripcion;
        $table->calorias_quemadas = $request->calorias_quemadas;
        // $table->estado= '1';
        $table->save();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        // if (!$request->ajax()) return redirect('/');
        $table =  ActividadFisica::findOrFail($request->id);
        $table->nombre = $request->nombre;
        $table->descripcion = $request->descripcion;
        $table->calorias_quemadas = $request->calorias_quemadas;
        
        // $table->estado= '1';
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
        $table=ActividadFisica::find($id);
        $table->delete();
    }
}
