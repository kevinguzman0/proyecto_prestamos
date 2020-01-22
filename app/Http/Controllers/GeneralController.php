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

class GeneralController extends Controller
{

    public function tablaPerfiles()
    {

        $perfiles = Perfil::paginate(10);
        return view('general.tablaPerfiles', compact('perfiles'));

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

        if ($usuario == null)
        {
            $mensajeError = 'Atención, la información de registro del Usuario [ ' . $idUsuario . ' ] no está disponible. Es imposible proceder con la validación de la cuenta. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);        
        }

        $usuario->email_verified_at = now();
        $usuario->save();
        
        $mensaje = 'La cuenta del Usuario [ ' . $idUsuario . ' ] fue validada y ya puede ingresar en el sistema...';
        
        return redirect()->back()->with('mensajeVerde', $mensaje);

    }

}
