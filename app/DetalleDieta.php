<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleDieta extends Model
{
    protected $fillable=['id_dieta','id_orden'];
    public $timestamps = false;
}
