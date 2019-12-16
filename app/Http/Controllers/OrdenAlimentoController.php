<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdenAlimento;
use App\DetalleOrden;
use App\DetalleAlimento;
use Illuminate\Support\Facades\DB;
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
        $fecha=$request->fecha;

        $table=OrdenAlimento::where('fecha','=',$fecha)
        ->get();
        if(count($table)>0){

        $table[0]->detalle=OrdenAlimento::join('detalle_ordens','orden_alimentos.id','=','detalle_ordens.id_orden')
        ->join('detalle_alimentos','detalle_ordens.id_alimento','=','detalle_alimentos.id')
        ->join('menus','detalle_alimentos.id_menu','=','menus.id')
        ->join('alimentos','detalle_alimentos.id_alimento','=','alimentos.id')
        ->where('orden_alimentos.id','=',$table[0]->id)
        ->where('detalle_ordens.estado','=','1')
        ->select('menus.id','menus.nombre')
        ->groupBy('menus.id','menus.nombre')
        ->get();
        foreach ($table[0]->detalle as $value) {
            $value->detalle=OrdenAlimento::join('detalle_ordens','orden_alimentos.id','=','detalle_ordens.id_orden')
            ->join('detalle_alimentos','detalle_ordens.id_alimento','=','detalle_alimentos.id')
            ->join('menus','detalle_alimentos.id_menu','=','menus.id')
            ->join('alimentos','detalle_alimentos.id_alimento','=','alimentos.id')
            ->where('menus.id','=',$value->id)
            ->where('detalle_ordens.id_orden','=',$table[0]->id)
            ->where('detalle_ordens.estado','=','1')
            ->select('detalle_ordens.id','detalle_ordens.cantidad','alimentos.nombre','detalle_ordens.sub_calorias','detalle_ordens.sub_carbohidratos','detalle_ordens.sub_grasas','detalle_ordens.sub_proteinas','alimentos.peso')
            ->groupBy('detalle_ordens.id','detalle_ordens.cantidad','alimentos.nombre','detalle_ordens.sub_calorias','detalle_ordens.sub_carbohidratos','detalle_ordens.sub_grasas','detalle_ordens.sub_proteinas','alimentos.peso')
            ->get();
        }
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
            $fecha=$request->fecha;

            $table=OrdenAlimento::where('fecha','=',$fecha)
            ->get();
            // return $table[0]->id;
            if(count($table)>0)
            {
                $data=$request->alimento;
                $cantidad=$request->cantidad;

                    $detalle=DetalleOrden::updateOrInsert(['id_orden' =>$table[0]->id,'id_alimento'=>$request->id_alimento],
                    ['cantidad'=>$cantidad,'sub_calorias'=>$data['calorias']*$cantidad,
                    'sub_carbohidratos'=>$data['carbohidratos']*$cantidad,'sub_grasas'=>$data['grasas']*$cantidad,
                    'sub_proteinas'=>$data['proteinas']*$cantidad,'estado'=>'1']);
                


                $calorias=DetalleOrden::where('id_orden','=',$table[0]->id)
                ->where('estado','=','1')
                ->sum('sub_calorias');
                $carbohidratos=DetalleOrden::where('id_orden','=',$table[0]->id)
                ->where('estado','=','1')
                ->sum('sub_carbohidratos');
                $grasas=DetalleOrden::where('id_orden','=',$table[0]->id)
                ->where('estado','=','1')
                ->sum('sub_grasas');
                $proteinas=DetalleOrden::where('id_orden','=',$table[0]->id)
                ->where('estado','=','1')
                ->sum('sub_proteinas');

                $ta=OrdenAlimento::find($table[0]->id);
                $ta->total_calorias=$calorias;
                $ta->total_carbohidratos=$carbohidratos;
                $ta->total_grasas=$grasas;
                $ta->total_proteinas=$proteinas;
                $ta->save();
            }
            else
            {
                $table= new OrdenAlimento();
                $table->fecha=$request->fecha;
                $table->total_calorias=0;
                $table->total_carbohidratos=0;
                $table->total_grasas=0;
                $table->total_proteinas=0;
                $table->save();

                $data=$request->alimento;
                $cantidad=$request->cantidad;
       
                    $detalle=DetalleOrden::updateOrInsert(['id_orden' =>$table->id,'id_alimento'=>$request->id_alimento],
                    ['cantidad'=>$cantidad,'sub_calorias'=>$data['calorias']*$cantidad,
                    'sub_carbohidratos'=>$data['carbohidratos']*$cantidad,'sub_grasas'=>$data['grasas']*$cantidad,
                    'sub_proteinas'=>$data['proteinas']*$cantidad,'estado'=>'1']);

                $calorias=DetalleOrden::where('id_orden','=',$table->id)
                ->where('estado','=','1')
                ->sum('sub_calorias');
                $carbohidratos=DetalleOrden::where('id_orden','=',$table->id)
                ->where('estado','=','1')
                ->sum('sub_carbohidratos');
                $grasas=DetalleOrden::where('id_orden','=',$table->id)
                ->where('estado','=','1')
                ->sum('sub_grasas');
                $proteinas=DetalleOrden::where('id_orden','=',$table->id)
                ->where('estado','=','1')
                ->sum('sub_proteinas');

                $ta=OrdenAlimento::find($table->id);
                $ta->total_calorias=$calorias;
                $ta->total_carbohidratos=$carbohidratos;
                $ta->total_grasas=$grasas;
                $ta->total_proteinas=$proteinas;
                $ta->save();
            }
            // $fecha= date('yy-mm-dd');
        //     $fecha= Carbon::now('America/La_Paz');
        //     // $table=OrdenAlimento::updateOrInsert(['fecha'=>'2019-12-08'],
        //     //     ['total_calorias'=>100,'total_carbohidratos'=>120,'total_grasas'=>123,'total_proteinas'=>121]);
        // $table= new OrdenAlimento();
        // $table->fecha='2019-12-08';
        // // $table->total_calorias=$request->total_calorias;
        // // $table->total_carbohidratos=$request->total_carbohidratos;
        // // $table->total_grasas=$request->total_grasas;
        // // $table->proteinas=$request->proteinas;
        // $table->total_calorias=100;
        // $table->total_carbohidratos=200;
        // $table->total_grasas=300;
        // $table->total_proteinas=400;
        // $table->save();
        

        // return ['table'=>$table ];

        DB::commit();
    } catch (Exception $e){
        DB::rollBack();
        return $e;
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

            $detalle=DetalleOrden::updateOrInsert(['id_orden' =>$request->id_orden,'id_alimento'=>$request->id_alimento],
            ['cantidad'=>$request->cantidad,'estado'=>'1']);

            // $table=OrdenAlimento::findOrfail($request->id_orden);
            // $table->total_calorias=100;
            // $table->total_carbohidratos=200;
            // $table->total_grasas=300;
            // $table->total_proteinas=400;
            // $table->save();
            // return $request;

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
        $table->estado='0';
        $table->delete();
    }
    public function destroy_detalle(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        $table=DetalleOrden::findOrfail($request->id);
        $table->estado='0';
        $table->save();
    }
}
