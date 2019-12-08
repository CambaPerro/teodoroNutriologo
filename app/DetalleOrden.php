<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    protected $fillable=['id_orden','id_alimento','cantidad'];
    public $timestamps = false;
}
