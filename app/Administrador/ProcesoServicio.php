<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class ProcesoServicio extends Model
{
    protected $table = 'procesoservicio';
    protected $primaryKey = 'nid_procesoservicio';
    public $timestamps = false;

    protected $fillable = [
        'nid_servicio',
    	'nid_proceso',
    	'nestado'
    ];
}


