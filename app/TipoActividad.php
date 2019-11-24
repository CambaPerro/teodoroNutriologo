<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    protected $fillable=['nombre','descripcion'];
    public $timestamps = false;
}
