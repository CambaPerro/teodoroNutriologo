<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlimentoDieta extends Model
{
    protected $fillable=['id_dieta','id_alimento'];
    public $timestamps = false;
}
