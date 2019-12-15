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
        // if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $table=TipoActividad::where('tipo','like','%'.$buscar.'%')
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
        // if (!$request->ajax()) return redirect('/');
        $table= new TipoActividad();
        $table->tipo = $request->tipo;
        
        // $table->estado= '1';
        $table->save();
    }

    public function select(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $buscar=$request->buscar;
        $table=TipoActividad::where('tipo','like','%'.$buscar.'%')
        ->get();
        return ['table' => $table];
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
