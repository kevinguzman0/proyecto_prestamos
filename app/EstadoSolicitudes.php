<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoSolicitudes extends Model
{
    protected $fillable=[
    	'nombreEstado', 'descripcionEstado',
    ];

    protected $table='estado_solicitudes';

    protected $primarykey='id';
}
