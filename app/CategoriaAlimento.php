<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaAlimento extends Model
{
    protected $fillable=['nombre'];
    public $timestamps = false;
}
