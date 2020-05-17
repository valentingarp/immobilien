<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class PermisoProyecto extends Model
{
    protected $table = 'permisoproyecto';
    protected $primaryKey = 'nid_permisoproyecto';
    public $timestamps = false;

    protected $fillable = [
        'nid_persona',
    	'nestado'
    ];
}
