<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerfilesUsuario extends Model
{
    protected $fillable=['nombrePerfil', 'descripcionPerfil'];
    protected $table=['perfiles_usuario'];
    protected $primarykey=['id'];
}
