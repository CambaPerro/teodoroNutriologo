<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleAlimento extends Model
{
    // protected $fillable=['id_orden','id_alimento','cantidad','estado'];
    public $timestamps = false;
    
    public function alimento(){
        return $this->belongsTo('App\Alimento','id_alimento');
        }
        
}
