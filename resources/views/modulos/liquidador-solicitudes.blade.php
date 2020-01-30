<form method="POST" class="boton-acciones boton-acciones-inline" action="{{ route('simulador.screen') }}">

    @csrf
    
    <input type="hidden" name="valorPrestamo" value="{{ $fila->monto }}">
    <input type="hidden" name="plazoCuotas" value="{{ $fila->plazo }}">
    <input type="hidden" name="interes" value="{{ $fila->interes }}">

    <button type="submit" class="button-image">
    	<img src="{{ asset('icons/document-spreadsheet.svg') }}" alt="Generar tabla de pagos" width="36" height="36" title="Generar tabla de pagos">
    </button>
    
</form>

