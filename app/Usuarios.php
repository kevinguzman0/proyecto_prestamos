<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $fillable=[
   	'idPerfilUsuario', 'cedula', 'nombres', 'apellidos', 'foto', 'email',
	'telefono1', 'telefono2', 'direccion', 'barrio', 'cuidad', 'areaTrabajo', 'cargoTrabajo'
	];
	protected $table='usuarios';

	protected $primaryKey='id';
}
