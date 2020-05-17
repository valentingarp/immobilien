<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class DocumentoPersona extends Model
{
    protected $table = 'documentopersona';
    protected $primaryKey = 'nid_docpersona';
    public $timestamps = false;

    protected $fillable = [
        'nid_persona',
    	'ntipodoc',
    	'cdocnro',
    ];
}
