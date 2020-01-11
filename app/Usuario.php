<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

	protected $table = 'usuarios';
 
    protected $fillable = [
    	'id',
   		'idPerfilUsuario', 
   		'cedula', 
   		'nombres', 
   		'apellidos', 
   		'foto', 
   		'email',
		'telefono1', 
		'telefono2', 
		'fechaNacimiento', 
		'direccion', 
		'barrio', 
		'ciudad', 
		'areaTrabajo', 
		'cargoTrabajo',
		'afiliadoFondo',
	];

	protected $primaryKey = 'id';

	public function user()
	{
	
		return $this->hasOne('App\User', 'id', 'id');
	
	}

    public function perfil()
    {
       return $this->hasOne('App\PerfilUsuario', 'id', 'idPerfilUsuario');
    }  

    public function solicitudes()
    {
       return $this->hasMany('App\Solicitud', 'idCliente', 'id');
    }

}
