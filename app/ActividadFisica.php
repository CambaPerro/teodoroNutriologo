<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadFisica extends Model
{
    protected $fillable=['id_tipo','nombre','descripcion'];
    public $timestamps = false;
}
