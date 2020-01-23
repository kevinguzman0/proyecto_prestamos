<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';

    protected $fillable = [
        'idSolicitud', 
        'documento',
        'archivoOriginal',
        'descripcionDocumento', 
        'revisado', 
        'aprobado', 
        'idAnalizadoPor', 
        'analizadoEn', 
    ];

    protected $primaryKey = 'id';

    public function solicitud()
    {
       return $this->hasOne('App\Solicitud', 'id', 'idSolicitud');
    }  

    public function revisor()
    {
    
        return $this->hasOne('App\Perfil', 'id', 'idAnalizadoPor');
    
    }

}
