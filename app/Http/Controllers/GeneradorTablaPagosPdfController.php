<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Session;

use Illuminate\Support\Facades\App;

class GeneradorTablaPagosPdfController extends Controller
{
    public function generarPdfTablaPagos(Request $request) 
    {
    	
        $valorPrestamo = $request->session()->get('valorPrestamo');
        $plazoCuotas = $request->session()->get('plazoCuotas');
        
		$controller = App::make('\App\Http\Controllers\TablaPagosPdfController');
		$data = $controller->callAction('generarTablaPagos', compact('valorPrestamo', 'plazoCuotas'));

        $pdf = \PDF::loadView('generadorTablaPagosPdf', $data);
        $pdf->setpaper('letter', 'portrait');
        return $pdf->stream();

    }

}
