<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    // protected $fillable=['id_categoria','nombre','calorias','carbohidratos','grasas','proteinas','peso'];
    public $timestamps = false;
    protected $appends = ['categoria'];

    public function categoria (){
    return $this->belongsTo('App\Categoria','id_categoria');
    }

    public function getCategoriaAttribute(){
        return $this->categoria()->first(['nombre'])->nombre;
    }

   
}