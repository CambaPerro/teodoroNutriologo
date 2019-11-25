<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAlimento extends Model
{
    protected $fillable=['id_orden','id_alimento','cantidad','porcion'];
    public $timestamps = false;
}
