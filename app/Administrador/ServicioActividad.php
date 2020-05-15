<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class ServicioActividad extends Model
{
    protected $table = 'servicioactividad';
    protected $primaryKey = 'nid_servicioactividad';
    public $timestamps = false;

    protected $fillable = [
        'nid_procesoservicio',
    	'nid_actividad',
    	'ncodetapa',
    	'nestado'
    ];
}
