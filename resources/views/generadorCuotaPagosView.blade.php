@extends('simulador')

@section('contenidoCuota')
	
    <div class="row col-md-12">
        <h5>CUOTA ESTIMADA PARA EL CRÉDITO</h5>
    </div>

	<div class="row col-md-12 mb-3 mt-3">
		<h5 class="">
			La cuota estimada para un crédito de <span class="font-italic text-muted">{{ $valorPrestamo }}</span> pagadero en un plazo de <span class="font-italic text-muted">{{ $plazoCuotas }}</span> meses (cuotas) con un interés mensual del <span class="font-italic text-muted">{{ $interes }}</span> es de <span class="font-italic text-muted">{{ $valorCuota }}</span>.
		</h5>
	</div>

    <div class="form-row col-md-12 mb-4 pl-0 pr-0">

        <form class="col-md-12 pl-0 pr-0" 
              method="POST">

            @csrf

            <input type="hidden" readonly name="valorPrestamo" value="{{ Session::get('valorPrestamo')}}" class="form-control">

            <input type="hidden" readonly name="plazoCuotas" value="{{ Session::get('plazoCuotas')}}" class="form-control">

            <div class="col-md-3 pl-0 pr-0">
                <label></label>
                <input type="submit" formaction="{{ route('tablaPagosView') }}" value="Visualizar tabla de pagos" name="btnTablaPagos" class="form-control btn btn-dark">
            </div>

        </form>

    </div>

@endsection
