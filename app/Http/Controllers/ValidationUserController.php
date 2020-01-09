<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;

class ValidationUserController extends Controller
{

    public function create(Request $request)
    {
        return view('formUsuario');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cedula' => 'required|unique:usuarios',
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
        ]);

        Usuarios::create($request->all());
        $file=$request->file('foto');
        $ext = $request->file('foto')->getClientOriginalExtension();
        $cedula=$request->cedula;
        $nombre='foto_usuario_' . $cedula . '.' . $ext;
        \Storage::disk('local')->put($nombre, \File::get($file));

        return '';
    }
}
