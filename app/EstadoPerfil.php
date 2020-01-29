<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoPerfil extends Model
{

    protected $table='estados_perfil';

    protected $fillable=[
    	'nombreEstado', 
    	'descripcionEstado',
    ];

    protected $primarykey='id';

    public function perfiles()
    {
       return $this->hasMany('App\Perfil', 'idEstadoPerfil', 'id')->withDefault();
    }     

}
