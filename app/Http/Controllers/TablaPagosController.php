<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use NumberFormatter;
use File;
use Session;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\App;

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
    public function vistaTablaPagos(Request $request)
    {

        $valorPrestamo = (int)$request->input("valorPrestamo");
        $plazoCuotas = (int)$request->input("plazoCuotas");

        $request->session()->put('valorPrestamo', $valorPrestamo);
        $request->session()->put('plazoCuotas', $plazoCuotas);

        $saldoInicial = $valorPrestamo;
        $interes = config('prestamos.interes') / 100;
        $decimales = 4;
        $i = 1;
        $fmt = new NumberFormatter("en-US", NumberFormatter::CURRENCY);
        $listaPagos = array();

        if (($valorPrestamo == 0) || ($plazoCuotas == 0))
        {
           $valorCuota = 0;
           $plazoCuotas = 0;
        }
        else
        {
            $valorCuota = round($valorPrestamo * ((((1 + $interes) ** $plazoCuotas) * $interes) / (((1 + $interes) ** $plazoCuotas) - 1)), $decimales);
        }

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

        // Retornar el valor original del interés. Tal como está almacenado en configuración.
        $interes = $interes * 100;

        $data = compact("valorPrestamo", "plazoCuotas", "interes", "valorCuota", "listaPagos");

        return view('simulador.tablaPagosScreen', $data);

    }

    public function datosTablaPagos($parametro1, $parametro2)
    {

        $valorPrestamo = $parametro1;
        $plazoCuotas = $parametro2;

        $saldoInicial = $valorPrestamo;
        $interes = config('prestamos.interes') / 100;
        $decimales = 4;
        $i = 1;
        $fmt = new NumberFormatter("en-US", NumberFormatter::CURRENCY);
        $listaPagos = array();

        if (($valorPrestamo == 0) || ($plazoCuotas == 0))
        {
           $valorCuota = 0;
           $plazoCuotas = 0;
        }
        else
        {
            $valorCuota = round($valorPrestamo * ((((1 + $interes) ** $plazoCuotas) * $interes) / (((1 + $interes) ** $plazoCuotas) - 1)), $decimales);
        }

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

    public function pdfTablaPagos(Request $request) 
    {
        
        $valorPrestamo = $request->session()->get('valorPrestamo');
        $plazoCuotas = $request->session()->get('plazoCuotas');
        
        $controller = App::make('\App\Http\Controllers\TablaPagosController');
        $data = $controller->callAction('datosTablaPagos', compact('valorPrestamo', 'plazoCuotas'));

        $pdf = \PDF::loadView('simulador.tablaPagosPdf', $data);
        $pdf->setpaper('letter', 'portrait');
        return $pdf->stream();

    }

    public function vistaCuotaCredito(Request $request)
    {

        $valorPrestamo = (int)$request->input("valorPrestamo");
        $plazoCuotas = (int)$request->input("plazoCuotas");

        $request->session()->put('valorPrestamo', $valorPrestamo);
        $request->session()->put('plazoCuotas', $plazoCuotas);

        $saldoInicial = $valorPrestamo;
        $interes = config('prestamos.interes') / 100;
        $decimales = 4;

        $fmt = new NumberFormatter("en-US", NumberFormatter::CURRENCY);

        if (($valorPrestamo == 0) || ($plazoCuotas == 0))
        {
           $valorCuota = 0;
           $plazoCuotas = 0;
        }
        else
        {
            $valorCuota = round($valorPrestamo * ((((1 + $interes) ** $plazoCuotas) * $interes) / (((1 + $interes) ** $plazoCuotas) - 1)), $decimales);
        }

        $valorPrestamo = $fmt->format($valorPrestamo);
        $interes = config('prestamos.interes') . "%";
        $valorCuota = $fmt->format($valorCuota);

        $data = compact("valorPrestamo", "plazoCuotas", "interes", "valorCuota");

        return view('simulador.cuotaPagosScreen', $data);

    }

}