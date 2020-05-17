<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividad';
    protected $primaryKey = 'nid_actividad';
    public $timestamps = false;

    protected $fillable = [
        'cactividad',
    	'dfechacreate',
    	'nestado'
    ];
}
