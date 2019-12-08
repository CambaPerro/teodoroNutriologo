<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdenAlimento;
use App\DetalleAlimento;
use DB;

class OrdenAlimentoController extends Controller
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
        $table=OrdenAlimento::where('nombre','like','%'.$buscar.'%')
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
    public function listar_alimento(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $id = $request->id;

        $detalle = DetalleAlimento::where('id_orden','=',$request->id)
        ->where('estado','=','1')
        ->with('alimento')        
        ->get();

        return ['detalle'=>$detalle];
    }
    public function store(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        DB::beginTransaction();
        try{    
        $table= new OrdenAlimento();
        $table->nombre=$request->nombre;
        $table->save();

        $data=$request->data;

        foreach ($data as $key => $det) {
            $detalle=new DetalleAlimento();
            $detalle->id_orden=$table->id;
            $detalle->id_alimento=$det['id_alimento'];
            $detalle->cantidad=$det['cantidad'];
            $detalle->porcion=$det['porcion'];
            $detalle->estado='1';
            $detalle->save();
        }

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
        DB::beginTransaction();
        try{    
            $table=OrdenAlimento::findOrfail($request->id);
            $table->nombre=$request->nombre;
            $table->save();
            $detalles = DetalleAlimento::where('id_orden','=',$table->id)->update(['estado'=>'0']);

        $data=$request->data;
        
        foreach ($data as $key => $det) {
            if($data['cantidad']!=0 && $data['cantidad']!=null){
            $detalle=DetalleAlimento::updateOrInsert(['id_orden' =>$table->id,'id_alimento'=>$det['id_alimento']],
                ['cantidad'=>$det['cantidad'],'porcion'=>$det['porcion'],'estado'=>'1']);
            }
            else{
                $detalle=DetalleAlimento::updateOrInsert(['id_orden' =>$table->id,'id_alimento'=>$det['id_alimento']],
                ['cantidad'=>0,'porcion'=>$det['porcion'],'estado'=>'0']);
            }
        }

        DB::commit();
    } catch (Exception $e){
        DB::rollBack();
    }
        

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
        $table=OrdenAlimento::find($id);
        $table->delete();
    }
}
