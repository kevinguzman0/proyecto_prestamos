<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use NumberFormatter;

class TablaPagosController extends Controller
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
    public function index(Request $request)
    {

        $valorPrestamo = $request->input("valorPrestamo");
        $plazoCuotas = $request->input("plazoCuotas");
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
            $listaPagos[$i]["saldo_inicial"] = $fmt->format($saldoInicial);
            $listaPagos[$i]["valor_cuota"] = $fmt->format($valorCuota);
            $listaPagos[$i]["intereses"] = $fmt->format($intereses);
            $listaPagos[$i]["abono_k"] = $fmt->format($abonoK);
            $listaPagos[$i]["saldo_k"] = $fmt->format($saldoK);

            $i++;

            $saldoInicial = $saldoK;
        
        }

        /*
        print("<pre>");
        print_r($listapagos);
        print("</pre>");
        */

        return view('liquidador', compact("valorPrestamo", "plazoCuotas", "interes", "valorCuota", "listaPagos"));
    }

}
