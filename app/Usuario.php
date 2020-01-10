<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{

	protected $table='usuarios';

    protected $fillable=[
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

	protected $primaryKey='id';

}
