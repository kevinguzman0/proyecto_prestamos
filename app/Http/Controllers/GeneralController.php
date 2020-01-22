<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\User;

use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function tablaPerfiles(){

        $perfiles = Perfil::paginate(10);
        return view('general.tablaPerfiles', compact('perfiles'));

    }

    public function tablaUsuarios(){

        $usuarios = User::paginate(10);
        return view('general.tablaUsuarios', compact('usuarios'));

    }

    public function usuarioEliminar($idUsuario){

    	$usuario = User::find($idUsuario);
 
        if ($usuario == null)
        {
            $mensajeError = 'Atención, la información de registro del Usuario [ ' . $idUsuario . ' ] no está disponible. Es imposible proceder con la eliminación del usuario. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);        
        }

    	$perfil = Perfil::find($idUsuario);

    	if ($perfil != null) 
        {
    		$perfil->delete();
            $mensaje = 'El Usuario [ ' . $idUsuario . ' ] fue eliminado con toda su información de Perfil...';
    	}
        else
        {
            $mensaje = 'El Usuario [ ' . $idUsuario . ' ] fue eliminado...';
        }

     	$usuario->delete();
        
        return redirect()->back()->with('mensajeVerde', $mensaje);

    }

    public function usuarioValidar($idUsuario){

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
