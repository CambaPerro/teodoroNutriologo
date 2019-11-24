<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActividadFisica extends Model
{
    protected $fillable=['id_actividad_fisica','tipo'];
    public $timestamps = false;
}
