<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    protected $primaryKey = 'nid_proyecto';
    public $timestamps = false;

    protected $fillable = [
    	'cproyecto',
        'nid_cliente',
    	'nid_procesoservicio',
    	'nid_servicioactividad',
    	'nid_estadoproyecto',
    	'nestado'
    ];
}
