<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    protected $fillable = [
        'monto', 'plazo', 'cuota15', 'cuota30', 'tasa', 'idEstadoSolictud', 'idCliente',
    ];

    protected $table = 'solicitudes';

    protected $primaryKey = 'id';
}