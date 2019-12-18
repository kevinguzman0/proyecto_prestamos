<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;

class ValidationUser extends Controller
{
    public function index(Request $request)
    {

        Usuarios::create($request->all());
        $file=$request->file('foto');
        $ext = $request->file('foto')->getClientOriginalExtension();
        $cedula=$request->cedula;
        $nombre='foto_usuario_' . $cedula . '.' . $ext;
        \Storage::disk('local')->put($nombre, \File::get($file));
        //$request->foto->storeAs($nombre)

        return 'soii';
    }
}
