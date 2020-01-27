<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html class="pdf-html">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <title>Préstamos de Libre Inversión</title>

        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    </head>

    <body class="pdf-body">

        <div class="pdf-header">
            
            <span>Préstamos de Libre Inversión</span>
            <br>
            <span>Tabla de Pagos</span>
            <br>
            <span>

                Crédito de <span class="font-italic text-muted">{{ $fValorPrestamo }}</span>, pagadero en un plazo de <span class="font-italic text-muted">{{ $plazoCuotas }}</span> meses (cuotas), con un interés mensual del <span class="font-italic text-muted">{{ $fInteres }}</span> y cuota estimada de <span class="font-italic text-muted">{{ $fValorCuota }}</span>.

            </span>

        </div>

        <table id="tabla-pagos" class="pdf-table">

            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Capital Inicial</th>
                    <th>Cuota</th>
                    <th>Intereses</th>
                    <th>Abono a Capital</th>
                    <th>Capital Final</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($listaPagos as $fila)

                    <tr>

                        <td style="text-align:center; font-weight: bold;">
                            {{ $fila['cuota'] }} 
                        </td>
                        <td> {{ $fila['saldoInicial'] }} </td>
                        <td> {{ $fila['valorCuota'] }} </td>
                        <td> {{ $fila['intereses'] }} </td>
                        <td> {{ $fila['abonoK'] }} </td>
                        <td> {{ $fila['saldoK'] }} </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

        <script type="text/php">

            if (isset($pdf)) 
            {
                $pdf->page_script('$font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal"); $pdf->text(270, 755, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);');
            }
            
        </script>        

    </body>

</html>