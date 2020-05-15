<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $table = 'proceso';
    protected $primaryKey = 'nid_proceso';
    public $timestamps = false;

    protected $fillable = [
        'cproceso',
    	'dfechacreate',
    	'nestado'
    ];
}
