<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TablaConfiguraciones extends Model
{
    protected $fillable=[
    	'nombreConfiguracion', 'valorConfiguracion', 'descripcionConfiguracion',
    ];
    protected $table='tabla_configuraciones';
    protected $primarykey='id';
}
