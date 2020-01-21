<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilUsuario extends Model
{

    protected $table='perfiles_usuario';

    protected $fillable=[
    	'nombrePerfil', 
    	'descripcionPerfil',
    ];

    protected $primarykey='id';

    public function perfiles()
    {
       return $this->hasMany('App\Perfil', 'idPerfilUsuario', 'id');
    }     

}
