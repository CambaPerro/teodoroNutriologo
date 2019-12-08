<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alimento;


class AlimentoController extends Controller
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
        $table=Alimento::where('nombre','like','%'.$buscar.'%')
        ->orderBy('id','desc')
        // ->with('categoria')
         ->paginate(10);
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
    public function select(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $table=Alimento::where('nombre','like','%'.$buscar.'%')
        ->take(10)
        ->get();
        return ['table' => $table];
    }
    public function listar(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $table=Alimento::where('nombre','like','%'.$buscar.'%')
        ->take(10)
        ->get();
        return ['table' => $table];
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
        $table= new Alimento();
        $table->id_categoria=$request->id_categoria;
        $table->nombre=$request->nombre;
        $table->calorias=$request->calorias;
        $table->carbohidratos=$request->carbohidratos;
        $table->grasas=$request->grasas;
        $table->proteinas=$request->proteinas;
        $table->peso=$request->peso;
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
        $table=Alimento::findOrfail($request->id);
        $table->id_categoria=$request->id_categoria;
        $table->nombre=$request->nombre;
        $table->calorias=$request->calorias;
        $table->carbohidratos=$request->carbohidratos;
        $table->grasas=$request->grasas;
        $table->proteinas=$request->proteinas;
        $table->peso=$request->peso;
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
        $table=Alimento::find($id);
        $table->delete();
    }
}
