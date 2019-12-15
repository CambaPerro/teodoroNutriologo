<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\DetalleAlimento;
use DB;

class MenuController extends Controller
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
        $table=Menu::where('nombre','like','%'.$buscar.'%')
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

        $detalle = DetalleAlimento::where('id_menu','=',$request->id)
        ->where('estado','=','1')
        ->with('alimento')        
        ->get();

        return ['detalle'=>$detalle];
    }
    public function listar_menu()
    {
        // if(!$request->ajax()) return redirect('/');
        $table=Menu::get();
        foreach ($table as $value) {
        $value->detalle=DetalleAlimento::where('id_menu','=',$value->id)
        ->with('alimento')
        ->get();
        }

        return $table;
    }
    public function store(Request $request)
    {
        // if(!$request->ajax()) return redirect('/');
        DB::beginTransaction();
        try{    
        $table= new Menu();
        $table->nombre=$request->nombre;
        $table->save();

        $data=$request->data;

        foreach ($data as $key => $det) {
            $detalle=new DetalleAlimento();
            $detalle->id_menu=$table->id;
            $detalle->id_alimento=$det['id_alimento'];
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
            $table=Menu::findOrfail($request->id);
            $table->nombre=$request->nombre;
            $table->save();
            $detalles = DetalleAlimento::where('id_menu','=',$table->id)->update(['estado'=>'0']);

        $data=$request->data;
        
        foreach ($data as $key => $det) {
            if($data['cantidad']!=0 && $data['cantidad']!=null){
            $detalle=DetalleAlimento::updateOrInsert(['id_menu' =>$table->id,'id_alimento'=>$det['id_alimento']],
                ['cantidad'=>$det['cantidad'],'estado'=>'1']);
            }
            else{
                $detalle=DetalleAlimento::updateOrInsert(['id_menu' =>$table->id,'id_alimento'=>$det['id_alimento']],
                ['estado'=>'0']);
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
        $table=Menu::find($id);
        $table->delete();
    }
}
