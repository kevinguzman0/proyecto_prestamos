<?php

namespace App\Http\Controllers;

use App\Solicitudes;
use Illuminate\Http\Request;

class ValidationSolicitudController extends Controller
{

    public function create(Request $request)
    {
        return view('formSolicitud');
    }

	public function store(Request $request){

        $validatedData = $request->validate([
            'cedula' => 'required|unique:usuarios',
            'monto' => 'required',
            'plazo' => 'required',
            'tasa' => 'required',
            'telefono1' => 'required',
            'telefono2' => 'required',
            'fechaNacimiento' => 'required',
            'direccion' => 'required',
            'barrio' => 'required',
            'ciudad' => 'required',
            'areaTrabajo' => 'required',
            'cargoTrabajo' => 'required',
        ]);

		 Solicitudes::create($request->all());
   		 return '';
	}   
}

