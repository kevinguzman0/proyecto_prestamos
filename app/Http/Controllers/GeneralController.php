<?php

namespace App\Http\Controllers;

use App\Perfil;

use App\User;

use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function tablaClientes(){

        $perfiles = Perfil::paginate(2);

        return view('general.tablaClientes', compact('perfiles'));

    }

    public function tablaUsuarios(){

        $usuarios = User::paginate(2);

        return view('general.tablaUsuarios', compact('usuarios'));

    }

    public function usuarioEliminar($idCliente){

    	$usuario = User::find($idCliente);
    	$perfil = Perfil::find($idCliente);

    	if ($perfil != null) {

    		$perfil->delete();

    	}

     	$perfil->delete();
   
        
        $mensaje = 'El usuario [ ' . $idCliente . ' ] fue eliminado...';

        return redirect()->back()->with('mensajeVerde', $mensaje);

    }

    public function usuarioValidar($idCliente){

    	$usuario = User::find($idCliente);

    	$validacion = $usuario->email_verified_at;

    	if ($validacion != null) {
    		
    		$validacion == Carbon::now();
    	}

    	$usuario->save();

    	$mensaje = 'El usuario [ ' . $idCliente . ' ] fue validado...';

        return redirect()->back()->with('mensajeVerde', $mensaje);
    }
}
