<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaAlimento;

class CategoriaAlimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $table=CategorioAlimento::where('nombre','like','%'.$buscar.'%')
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $table= new CategorioAlimento();
        $table->nombre=$request->nombre;
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
        // if(!$request->ajax()) return redirect('/');
        $table=CategorioAlimento::findOrfail($request->id);
        $table->nombre=$request->nombre;
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
        $table=CategorioAlimento::find($id);
        $table->delete();
    }
}