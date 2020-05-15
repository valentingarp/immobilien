<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class Personageoubicacion extends Model
{
    protected $table = 'personageoubicacion';
    protected $primaryKey = 'nid_persona';
    public $timestamps = false;

    protected $fillable = [
        'cubigeo_regions',
    	'cubigeo_provinces',
    	'cubigeo_districts',
    	'nestado',
    ];
}
