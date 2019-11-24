<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alimento extends Model
{
    protected $fillable=['id_orden','id_categoria','nombre','porcion','calorias','carbohidratos','grasas','proteinas'];
    public $timestamps = false;
}
