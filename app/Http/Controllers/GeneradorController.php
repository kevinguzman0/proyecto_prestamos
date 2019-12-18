<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf \ Dompdf ;
use PDF;

class GeneradorController extends Controller
{
    public function pdf() 
    {
    	
		$view =  \View::make('generarPdf1')->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('generarPdf1');
    }

}
