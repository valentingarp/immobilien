<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class ProcesoFase extends Model
{
    protected $table = 'procesofase';
    protected $primaryKey = 'nid_procesofase';
    public $timestamps = false;

    protected $fillable = [
        'nid_proceso',
    	'nid_fase',
    	'nestado'
    ];
}
