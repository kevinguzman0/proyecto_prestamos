<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf \ Dompdf ;
use PDF;
use Session;

use Illuminate\Support\Facades\App;

class GeneradorController extends Controller
{
    public function pdf(Request $request) 
    {
    	
        $valorPrestamo = $request->session()->get('valorPrestamo');
        $plazoCuotas = $request->session()->get('plazoCuotas');
        
		$controller = App::make('\App\Http\Controllers\TablaPagosPdfController');
		$data = $controller->callAction('generarPdf', compact('valorPrestamo', 'plazoCuotas'));

        $pdf = \PDF::loadView('generarPdf1', $data);
        $pdf->setpaper('letter', 'portrait');
        return $pdf->stream();

    }

}
