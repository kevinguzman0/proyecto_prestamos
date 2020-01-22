<?php

namespace App\Http\Controllers;

use App\Usuario;

use App\User;

use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function tablaClientes(){

        $clientes = Usuario::paginate(2);

        return view('general.tablaClientes', compact('clientes'));

    }

    public function tablaUsuarios(){

        $usuarios = User::paginate(2);

        return view('general.tablaUsuarios', compact('usuarios'));

    }

    public function usuarioEliminar($idCliente){

    	$usuario = User::find($idCliente);
    	$perfil = Usuario::find($idCliente);

    	if ($perfil != null) {

    		$perfil->delete();

    	}

     	$usuario->delete();
   
        
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
