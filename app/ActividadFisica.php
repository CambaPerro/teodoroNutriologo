<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadFisica extends Model
{
    protected $fillable=['id_tipo','nombre','descripcion','calorias_quemadas'];
    public $timestamps = false;
    protected $appends = ['tipoactividad'];

    public function tipoactividad (){
    return $this->belongsTo('App\TipoActividad','id_tipo');
    }

    public function getTipoActividadAttribute(){
        return $this->tipoactividad()->first(['tipo'])->tipo;
    }
}
