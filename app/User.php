<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function perfil()
    {
       return $this->hasOne('App\Perfil', 'id', 'id'); 
    }   

    public function contarRevisiones($idUsuario)
    {
        $documentos = Documento::select('idAnalizadoPor')->where('idAnalizadoPor', '=', $idUsuario)->count();
        $solicitudes = Solicitud::select('idAnalizadoPor')->where('idAnalizadoPor', '=', $idUsuario)->count();

        return ($documentos + $solicitudes);
    } 

    public function listarRoles($idUsuario)
    {
        $roles = User::find($idUsuario)->getRoleNames();
        $listado = '';
        $cantidad = count($roles);
        $i = 1;

        foreach($roles as $rol)
        {
            $listado = $listado . ucfirst($rol);
            if ($i < $cantidad)
            {
                $listado = $listado . ', ';
                $i = $i + 1;
            }
        }

        return $listado;
    }

}
