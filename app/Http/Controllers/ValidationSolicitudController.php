<?php

namespace App\Http\Controllers;

use App\Solicitudes;
use Illuminate\Http\Request;

class ValidationSolicitudController extends Controller
{
	public function index(Request $request){
		 Solicitudes::create($request->all());
   		 return 'Solicitud creada';
	}   
}
