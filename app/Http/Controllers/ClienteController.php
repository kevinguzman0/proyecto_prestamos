<?php

namespace App\Http\Controllers;

use App\Usuario;

use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index(){

        $clientes = Usuario::paginate(2);

        return view('clientes.index', compact('clientes'));

    }
}
