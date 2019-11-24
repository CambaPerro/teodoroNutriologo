<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dieta;

class DietaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(!$request->ajax()) return redirect('/');
        $table=Dieta::where('id_usuario','=',auth()->id)
        ->get();
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
        // if(!$request->ajax()) return redirect('/');
        $table= new Dieta();
        $table->id_usuario=auth()->id;
        $table->fecha_inicio=$request->fecha_inicio;
        $table->fecha_fin=$request->fecha_fin;
        $table->peso_ideal=$request->peso_ideal;
        $table->calorias=$request->calorias;
        $table->imc=$request->imc;
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
        // if(!$request->ajax()) return redirect('/');
        $table=Dieta::findOrFail($request->id);
        $table->fecha_inicio=$request->fecha_inicio;
        $table->fecha_fin=$request->fecha_fin;
        $table->peso_ideal=$request->peso_ideal;
        $table->calorias=$request->calorias;
        $table->imc=$request->imc;
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
        // if(!$request->ajax()) return redirect('/');
        $table=Dieta::find($id);
        $table->delete();
    }
}
