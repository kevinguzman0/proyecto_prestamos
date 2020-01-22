<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Input;

class PerfilController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function miPerfil($idCliente)
    {

        $usuario = User::find($idCliente);

        if ($usuario == null)
        {
            $mensajeError = 'Atención, el Usuario [ ' . $idCliente . ' ] no está registrado. Contáctese con el administrador del sistema para revisar y corregir esta inconsistencia en la Base de Datos.';
            abort(404, $mensajeError);        
        }

        $perfil = Perfil::find($idCliente);

        if ($perfil == null) 
        {
            $emailUsuario = $usuario->email;
            return view('perfiles.nuevo', compact('idCliente', 'emailUsuario'));
        }
        else
        {
            $storagePath = Storage::disk('public')->path($perfil->foto);
            return view('perfiles.actualizar', compact('perfil', 'storagePath'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gestionarPerfil(Request $request, $idCliente)
    {

        $perfil = Perfil::find($idCliente);

        if ($perfil == null) 
        {

            $validatedData = Validator::make($request->all(),
                [
                    'cedula' => 'required|unique:perfiles',
                    'nombres' => 'required',
                    'apellidos' => 'required',
                    'email' => 'required|email|unique:perfiles',
                    'telefono1' => 'required',
                    'telefono2' => 'required',
                    'fechaNacimiento' => 'required',
                    'direccion' => 'required',
                    'barrio' => 'required',
                    'ciudad' => 'required',
                    'areaTrabajo' => 'required',
                    'cargoTrabajo' => 'required',
                    'afiliadoFondo' => 'required',
                    'foto'=> 'required|mimes:jpeg,bmp,png,gif,jfif|max:5120',
                ]);

            $perfil = new Perfil;
            $perfil->idPerfilUsuario = 1;
            $mensaje = 'Perfil creado correctamente...';

        }
        else
        {

            $validatedData = Validator::make($request->all(),
                [
                    'cedula' => 'required',
                    'nombres' => 'required',
                    'apellidos' => 'required',
                    'email' => 'required|email',
                    'telefono1' => 'required',
                    'telefono2' => 'required',
                    'fechaNacimiento' => 'required',
                    'direccion' => 'required',
                    'barrio' => 'required',
                    'ciudad' => 'required',
                    'areaTrabajo' => 'required',
                    'cargoTrabajo' => 'required',
                    'afiliadoFondo' => 'required',
                    'foto'=> 'required|mimes:jpeg,bmp,png,gif|max:5120',

                ]);

            if($perfil->email != $request->email)
            {
                $user = User::find($perfil->id);
                $user->email_verified_at = null;
                $user->email=$request->email;
                $user->save();
                return redirect()->route('salir');
            }

            $perfil->idPerfilUsuario = $request->idPerfilUsuario;
            $mensaje = 'Perfil actualizado correctamente...';

        }

        if($validatedData->fails())
        {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }

        $perfil->id = $idCliente;
        $perfil->cedula = $request->cedula;
        $perfil->nombres = $request->nombres;
        $perfil->apellidos = $request->apellidos;
        $perfil->email = $request->email;
        $perfil->telefono1 = $request->telefono1;
        $perfil->telefono2 = $request->telefono2;
        $perfil->fechaNacimiento = $request->fechaNacimiento;
        $perfil->direccion = $request->direccion;
        $perfil->barrio = $request->barrio;
        $perfil->ciudad = $request->ciudad;
        $perfil->areaTrabajo = $request->areaTrabajo;
        $perfil->cargoTrabajo = $request->cargoTrabajo;
        $perfil->afiliadoFondo = $request->afiliadoFondo;

        $file = $request->file('foto');
        $ext = $request->file('foto')->getClientOriginalExtension();
        $archivo = 'foto-id-' . $perfil->id . '.' . $ext;
        $perfil->foto = strtolower($archivo);

        Storage::disk('public')->put($archivo, File::get($file));
        $perfil->save();

        return redirect()->back()->with('mensajeVerde', $mensaje);

    }

}
