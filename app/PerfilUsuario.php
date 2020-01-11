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

    public function usuarios()
    {
       return $this->hasMany('App\Usuario', 'idPerfilUsuario', 'id');
    }     

}
