<?php

namespace App\Http\Controllers;

use App\Usuario;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UsuarioController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function miPerfil()
    {

        $id = auth()->user()->id;

        $usuario = Usuario::findOrFail($id);

        if ($usuario == null) 
        {
            return view('usuarios.nuevo');
        }
        else
        {
            $storagePath = Storage::disk('public')->path($usuario->foto);
            return view('usuarios.actualizar', compact('usuario', 'storagePath'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function usuarioPerfil(Request $request)
    {

        $id = auth()->user()->id;

        $usuario = Usuario::findOrFail($id);

        if ($usuario == null) 
        {

            $validatedData = Validator::make($request->all(),
                [
                    'cedula' => 'required|unique:usuarios',
                    'nombres' => 'required',
                    'apellidos' => 'required',
                    'email' => 'required|email|unique:usuarios',
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

            $usuario = new Usuario;
            $usuario->idPerfilUsuario = 1;
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

            if($usuario->email != $request->email)
            {
                $user = Usuario::find($usuario->id)->user;
                $user->email_verified_at = null;
                $user->email=$request->email;
                $user->save();
                return redirect()->route('salir');
            }

            $usuario->idPerfilUsuario = $request->idPerfilUsuario;
            $mensaje = 'Perfil actualizado correctamente...';

        }

        if($validatedData->fails())
        {
            return redirect()->back()->withInput()->withErrors($validatedData);
        }

        $usuario->id = $id;
        $usuario->cedula = $request->cedula;
        $usuario->nombres = $request->nombres;
        $usuario->apellidos = $request->apellidos;
        $usuario->email = $request->email;
        $usuario->telefono1 = $request->telefono1;
        $usuario->telefono2 = $request->telefono2;
        $usuario->fechaNacimiento = $request->fechaNacimiento;
        $usuario->direccion = $request->direccion;
        $usuario->barrio = $request->barrio;
        $usuario->ciudad = $request->ciudad;
        $usuario->areaTrabajo = $request->areaTrabajo;
        $usuario->cargoTrabajo = $request->cargoTrabajo;
        $usuario->afiliadoFondo = $request->afiliadoFondo;

        $file = $request->file('foto');
        $ext = $request->file('foto')->getClientOriginalExtension();
        $archivo = 'foto-id-' . $usuario->id . '.' . $ext;
        $usuario->foto = strtolower($archivo);

        Storage::disk('public')->put($archivo, File::get($file));
        $usuario->save();

        return redirect()->back()->with('mensajeVerde', $mensaje);

    }

}
