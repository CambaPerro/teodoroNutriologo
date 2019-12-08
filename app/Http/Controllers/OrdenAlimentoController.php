<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdenAlimento;
use App\DetalleOrden;
use App\DetalleAlimento;
use DB;
use Carbon\Carbon;

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
        // $buscar=$request->buscar;

        $table=OrdenAlimento::where('fecha','=','2019/12/08')
        ->first();
        // $table->detalle=DetalleOrden::where('id_orden','=',$table->id)
        // // ->with('detalle_alimento')
        // ->get();
        // foreach ($table->detalle as $value) {
        //     $value->detalle_alimento=DetalleAlimento::where('detalle_alimentos.id','=',$value->id_alimento)
        //     ->with('alimento')
        //     ->get();
        // }

        $table->detalle=OrdenAlimento::join('detalle_ordens','orden_alimentos.id','=','detalle_ordens.id_orden')
        ->join('detalle_alimentos','detalle_ordens.id_alimento','=','detalle_alimentos.id')
        ->join('menus','detalle_alimentos.id_menu','=','menus.id')
        ->join('alimentos','detalle_alimentos.id_alimento','=','alimentos.id')
        ->where('orden_alimentos.id','=',$table->id)
        ->select('menus.id','menus.nombre')
        ->groupBy('menus.id','menus.nombre')
        ->get();
        foreach ($table->detalle as $value) {
            $value->detalle=OrdenAlimento::join('detalle_ordens','orden_alimentos.id','=','detalle_ordens.id_orden')
            ->join('detalle_alimentos','detalle_ordens.id_alimento','=','detalle_alimentos.id')
            ->join('menus','detalle_alimentos.id_menu','=','menus.id')
            ->join('alimentos','detalle_alimentos.id_alimento','=','alimentos.id')
            ->where('menus.id','=',$value->id)
            ->where('orden_alimentos.id','=',$table->id)
            ->select('detalle_alimentos.id','detalle.alimentos.cantidad','alimentos.nombre','alimentos.calorias','alimentos.carbohidratos','alimentos.grasas','alimentos.proteinas','alimentos.peso')
            ->groupBy('detalle_alimentos.id','detalle.alimentos.cantidad','alimentos.nombre','alimentos.calorias','alimentos.carbohidratos','alimentos.grasas','alimentos.proteinas','alimentos.peso')
            ->get();
        }

        return $table;
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
            $fecha= Carbon::now('America/La_Paz');
        $table= new OrdenAlimento();
        $table->fecha=$fecha;
        $table->total_calorias=$request->total_calorias;
        $table->total_carbohidratos=$request->total_carbohidratos;
        $table->total_grasas=$request->total_grasas;
        $table->proteinas=$request->proteinas;
        $table->save();

        $data=$request->data;

        foreach ($data as $key => $det) {
            $detalle=new DetalleOrden();
            $detalle->id_orden=$table->id;
            $detalle->id_alimento=$det['id_alimento'];
            // $detalle->estado='1';
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
