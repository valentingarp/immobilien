<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class SevicioProceso extends Model
{
     protected $table = 'servicioproceso';
    protected $primaryKey = 'nid_servicioproceso';
    public $timestamps = false;

    protected $fillable = [
        'nid_servicio',
    	'nid_proceso',
    	'nestado'
    ];
}
