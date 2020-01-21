<?php

namespace App\Http\Controllers;

use App\Usuario;

use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function tablaClientes(){

        $clientes = Usuario::paginate(6);

        return view('clientes.index', compact('clientes'));

    }
}
