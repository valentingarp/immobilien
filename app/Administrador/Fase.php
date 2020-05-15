<?php

namespace App\Administrador;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $table = 'fase';
    protected $primaryKey = 'nid_fase';
    public $timestamps = false;

    protected $fillable = [
        'cfase',
    	'dfechacreate',
    	'nestado'
    ];
}
