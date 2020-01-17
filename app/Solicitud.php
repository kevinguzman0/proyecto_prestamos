<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{

    protected $table = 'solicitudes';

    protected $fillable = [
        'idCliente',
        'idEstadoSolicitud', 
        'monto', 
        'plazo', 
        'cuota', 
        'interes', 
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

    
    public function documentos()
    {
       return $this->hasMany('App\Documento', 'idSolicitud', 'id');
    }

}
