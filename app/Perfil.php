<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{

	protected $table = 'perfiles';
 
    protected $fillable = [
    	'id',
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

    public function solicitudes()
    {
       return $this->hasMany('App\Solicitud', 'idCliente', 'id'); 
    }

}
