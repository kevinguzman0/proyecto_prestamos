<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use NumberFormatter;

class TablaPagos extends Controller
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

        $valorDePrestamo=$request->input("valorDePrestamo");
        $plazoEnCuotas=$request->input("plazoEnCuotas");

        //Valor fijo del interes
        $interes = (0.25/100);
        $decimales=4;

        $valorCuota = round($valorDePrestamo * ((((1 + $interes)**$plazoEnCuotas)*$interes)/(((1 + $interes)**$plazoEnCuotas)-1)), $decimales);

        $i = 1;
        $saldoInicial = $valorDePrestamo;

        $listapagos=array();

        $fmt = new NumberFormatter("en-US", NumberFormatter::CURRENCY);

        while($i <= $plazoEnCuotas)
        {
            $intereses = round(($saldoInicial * $interes), $decimales);
            $abonoK = round(($valorCuota - $intereses), $decimales);
            $saldoK = round(($saldoInicial - $abonoK), $decimales);
            
            $listapagos[$i]["cuota"] = $i;
            $listapagos[$i]["saldo_inicial"] = $fmt->format($saldoInicial);
            $listapagos[$i]["valor_cuota"] = $fmt->format($valorCuota);
            $listapagos[$i]["intereses"] = $fmt->format($intereses);
            $listapagos[$i]["abono_k"] = $fmt->format($abonoK);
            $listapagos[$i]["saldo_k"] = $fmt->format($saldoK);

            $i++;
            $saldoInicial = $saldoK;
        }

        /*
        print("<pre>");
        print_r($listapagos);
        print("</pre>");
        */

        return view('liquidador', compact("valorDePrestamo", "plazoEnCuotas", "listapagos"));
    }

}
