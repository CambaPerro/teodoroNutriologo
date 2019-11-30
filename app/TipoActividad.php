<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoActividad extends Model
{
    protected $fillable=['tipo'];
    public $timestamps = false;
}
