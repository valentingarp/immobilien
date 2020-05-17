<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $primaryKey = 'nid_persona';
    public $timestamps = false;

    protected $fillable = [
        'nid_tipopersona',
    	'cnombre',
    	'capaterno',
    	'camaterno',
    	'dfnacimiento',
    	'cnumero_documento',
    	'ccorreo',
    	'creferencia',
    	'cdomicilio',
    	'ctelefono',
        'nsexo',
    	'ccelular',
    	'cciudad',
    	'npersoneria',
    	'nestado'
    ];
}
