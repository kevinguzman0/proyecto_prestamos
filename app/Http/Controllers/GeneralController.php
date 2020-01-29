<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\User;
use App\Solicitud;
use App\Documento;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use DB;

class GeneralController extends Controller
{

    public function tablaPerfiles()
    {

        $perfiles = Perfil::paginate(10);
        $cboEstadosPerfil = Perfil::select('idEstadoPerfil')->distinct()->get();

        return view('general.tablaPerfiles', compact('perfiles', 'cboEstadosPerfil'));

    }

    public function tablaUsuarios()
    {

        $usuarios = User::paginate(10);
        return view('general.tablaUsuarios', compact('usuarios'));

    }

    public function tablaSolicitudes()
    {

        $solicitudes = Solicitud::paginate(10);
        return view('general.tablaSolicitudes', compact('solicitudes'));

    }

    public function tablaDocumentos()
    {

        $documentos = Documento::paginate(10);
        return view('general.tablaDocumentos', compact('documentos'));

    }

    public function usuarioValidar($idUsuario)
    {

    	$usuario = User::find($idUsuario);

        if (!$usuario)
        {
            $mensajeError = 'Atención, la información de registro del Usuario [ ' . $idUsuario . ' ] no está disponible. Es imposible proceder con la validación de la cuenta. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);        
        }
        else
        {

            $usuario->email_verified_at = now();
            $usuario->save();
            
            $mensaje = 'La cuenta del Usuario [ ' . $idUsuario . ' ] fue validada y ya puede ingresar en el sistema...';
            
            return redirect()->back()->with('mensajeVerde', $mensaje);

        }
    
    }

    public function buscadorPerfiles(Request $request)
    {

        $filtro = $request->filtro;

        if (!$filtro)
        {
            $mensaje = 'El filtro no ha generado resultados visibles, pruebe con otra búsqueda...'; 
            return view('general.tablaPerfiles')->with('mensajeRojo', $mensaje);
        }
        else
        {

            Builder::macro('whereLike', function($attributes, string $searchTerm) {
                foreach(Arr::wrap($attributes) as $attribute) {
                    $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                }
                return $this;
            });

            $perfiles = Perfil::whereLike(['nombres', 'apellidos', 'cedula', 'email'], $filtro)->get();

            $mensaje = 'La información de Perfiles visualizada está filtrada por algunos campos que contienen el texto [ ' . $filtro . ' ]... ';

            return view('general.tablaPerfiles', compact('perfiles'))->with('mensajeVerde', $mensaje);

        }

    }

    public function cboEstadosPerfil()
    {

    }

    public function todosPerfiles()
    {

        $perfiles = Perfil::paginate(10);
        return view('general.tablaPerfiles', compact('perfiles'));

    }

}
