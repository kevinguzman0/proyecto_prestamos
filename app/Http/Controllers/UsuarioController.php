<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = auth()->user()->id;

        $usuario = Usuario::find($id);

        if ($usuario == null) 
        {
            return view('usuarios.nuevo');
        }
        else
        {
            return view('usuarios.actualizar', compact('usuario'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = auth()->user()->id;

        $usuario = Usuario::find($id);

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
                ]);

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
        $archivo = 'foto_usuario_' . $usuario->id . '_' . $usuario->cedula . '.' . $ext;

        $usuario->foto = $archivo;

        \Storage::disk('local')->put($archivo, \File::get($file));

        $usuario->save();

        return redirect()->back()->with('success', $mensaje);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuarios  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuarios  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuarios  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
