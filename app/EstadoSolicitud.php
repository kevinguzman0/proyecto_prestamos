<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoSolicitud extends Model
{

    protected $table='estados_solicitud';

    protected $fillable=[
    	'nombreEstado', 
    	'descripcionEstado',
    ];

    protected $primarykey='id';

    public function solicitudes()
    {
       return $this->hasMany('App\Solicitud', 'idEstadoSolicitud');
    }    

}
