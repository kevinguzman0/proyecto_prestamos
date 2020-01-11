<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{

    protected $table = 'solicitudes';

    protected $fillable = [
        'monto', 
        'plazo', 
        'cuota15', 
        'cuota30', 
        'tasa', 
        'idEstadoSolicitud', 
        'idCliente',
    ];

    protected $primaryKey = 'id';

    public function estado()
    {
       return $this->hasOne('App\EstadoSolicitud', 'id', 'idEstadoSolicitud');
    }  

	public function cliente()
	{
	
		return $this->hasOne('App\Usuario', 'id', 'idCliente');
	
	}

}
