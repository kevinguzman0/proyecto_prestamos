<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class ClienteController extends Controller
{

    public function index(){

        $clientes = Usuario::paginate(2);

        $data = compact('clientes');

        return view('clientes.index', $data);

    }
}
