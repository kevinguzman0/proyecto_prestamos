<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf \ Dompdf ;
//use File;

class GeneradorController extends Controller
{
    public function pdf() 
    {
        $dompdf  =  new  Dompdf(); 
        $pdf = \App::make('dompdf.wrapper');
        $codigo_fuente = file_get_contents('tmp/tmpReportePdf1.html');
        $pdf->loadHTML($codigo_fuente);
		//$dompdf = File::get('tmp/tmpReportePdf1.html', 'Archivo no encontrado');
		return $pdf -> stream('');
    }

}
