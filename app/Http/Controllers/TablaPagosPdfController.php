<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use NumberFormatter;
use File;

class TablaPagosPdfController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function generarPdf($parametro1, $parametro2)
    {

        $valorPrestamo = $parametro1;
        $plazoCuotas = $parametro2;

        $saldoInicial = $valorPrestamo;
        $interes = config('prestamos.interes') / 100;
        $decimales = 4;
        $i = 1;
        $fmt = new NumberFormatter("en-US", NumberFormatter::CURRENCY);
        $listaPagos = array();

        $valorCuota = round($valorPrestamo * ((((1 + $interes) ** $plazoCuotas) * $interes) / (((1 + $interes) ** $plazoCuotas) - 1)), $decimales);

        while($i <= $plazoCuotas)
        {
            
            $intereses = round(($saldoInicial * $interes), $decimales);
            $abonoK = round(($valorCuota - $intereses), $decimales);
            $saldoK = round(($saldoInicial - $abonoK), $decimales);
            
            $listaPagos[$i]["cuota"] = $i;
            $listaPagos[$i]["saldoInicial"] = $fmt->format($saldoInicial);
            $listaPagos[$i]["valorCuota"] = $fmt->format($valorCuota);
            $listaPagos[$i]["intereses"] = $fmt->format($intereses);
            $listaPagos[$i]["abonoK"] = $fmt->format($abonoK);
            $listaPagos[$i]["saldoK"] = $fmt->format($saldoK);

            $i++;

            $saldoInicial = $saldoK;
        
        }

        $data = compact("valorPrestamo", "plazoCuotas", "interes", "valorCuota", "listaPagos");
        
        return $data;
            
    }

}
