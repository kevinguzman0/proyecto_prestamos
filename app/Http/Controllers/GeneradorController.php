<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Dompdf \ Dompdf ;

class GeneradorController extends Controller
{
    public function pdf() 
    {
        $dompdf  =  new  Dompdf(); 
		$dompdf  = \View::make('')->render();
		$pdf = \App::make('dompdf.wrapper');
		$pdf->loadHTML($dompdf);
		return $pdf -> stream ();
    }

}
