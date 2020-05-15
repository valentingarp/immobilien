<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'servicio';
    protected $primaryKey = 'nid_servicio';
    public $timestamps = false;

    protected $fillable = [
        'cservicio',
    	'nestado'
    ];
}


