<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf \ Dompdf ;
use PDF;

use Illuminate\Support\Facades\App;

class GeneradorController extends Controller
{
    public function pdf() 
    {
    	
		$valorPrestamo = 20000000;
		$plazoCuotas = 60;
		$controller = App::make('\App\Http\Controllers\TablaPagosPdfController');
		$data = $controller->callAction('generarPdf', compact('valorPrestamo', 'plazoCuotas'));

        $pdf = \PDF::loadView('generarPdf1', $data);
        return $pdf->stream();

    }

}
