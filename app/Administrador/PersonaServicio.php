<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class PersonaServicio extends Model
{
    protected $table = 'personaservicio';
    protected $primaryKey = 'nid_personaservicio';
    public $timestamps = false;

    protected $fillable = [
        'nid_persona',
    	'nid_servicio',
    	'nestado',
    ];
}
