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
        'idAnalizadoPor', 
        'analizadoEn', 
    ];

    protected $primaryKey = 'id';

    public function estado()
    {
       return $this->hasOne('App\EstadoSolicitud', 'id', 'idEstadoSolicitud')->withDefault();
    }  

	public function cliente()
	{
	
		return $this->hasOne('App\Perfil', 'id', 'idCliente')->withDefault();
	
	}

    public function revisor()
    {
    
        return $this->hasOne('App\Perfil', 'id', 'idAnalizadoPor')->withDefault();
    
    }

    public function documentos()
    {
       return $this->hasMany('App\Documento', 'idSolicitud', 'id'); 
    }

}
