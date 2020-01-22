@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@section('content')
	
	<style>
		.page-break {
		    page-break-after: always;
		}
	</style>

    @yield('contenidoTabla')

    <script type="text/php">
	    if ( isset($pdf) ) {
	        $pdf->page_script('
	            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
	            $pdf->text(270, 730, "Pagina $PAGE_NUM de $PAGE_COUNT", $font, 10);
	        ');
	    }
	</script>

@endsection