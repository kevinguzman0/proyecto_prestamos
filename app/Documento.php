<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';

    protected $fillable = [
        'idSolicitud', 
        'documento', 
        'descripcionDocumento', 
        'revisado', 
        'aprobado', 
    ];

    protected $primaryKey = 'id';

    public function solicitud()
    {
       return $this->hasOne('App\Solicitud', 'id', 'idSolicitud');
    }  

}
