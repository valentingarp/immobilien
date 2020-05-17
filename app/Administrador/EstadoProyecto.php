<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class EstadoProyecto extends Model
{
    protected $table = 'estadoproyecto';
    protected $primaryKey = 'nid_estadoproyecto';
    public $timestamps = false;

    protected $fillable = [
        'cestadoproyecto',
    	'nestado'
    ];
}
