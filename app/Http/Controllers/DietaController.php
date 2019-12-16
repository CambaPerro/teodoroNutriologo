<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dieta;
use App\User;
use DB;
use Carbon\Carbon;

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
        $table=Dieta::where('id_usuario','=',auth()->id())
        ->orderBy('id','desc')
        ->limit(1)
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
        DB::beginTransaction();
        try {
        // $fecha= Carbon::now('America/La_Paz');
        $table= new Dieta();
        $table->id_usuario=auth()->id();
        $table->fecha_inicio=$request->fecha_inicio;
        $table->fecha_fin=$request->fecha_fin;
        $table->peso_ideal=$request->peso_ideal;
        $table->calorias=$request->calorias;
        $table->imc=$request->imc;
        $table->tipo=$request->tipo;
        $table->id_nivel=$request->id_nivel;
        $table->save();
        
        $user=User::findOrFail(auth()->id());
        $user->fecha_nacimiento=$request->fecha_nacimiento;
        $user->altura=$request->altura;
        $user->peso=$request->peso;
        $user->sexo=$request->sexo;
        $user->estado='1';
        $user->save();

        DB::commit();
    } catch (Exception $e){
        DB::rollBack();
    }
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
        $table->id_nivel=$request->id_nivel;
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
