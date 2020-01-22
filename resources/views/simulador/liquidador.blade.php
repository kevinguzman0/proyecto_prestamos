@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="container-fluid">

		<div id="condicionesSimulacion">
		
		    <div class="row col-md-12 mt-3">
		        <h5>CONDICIONES PARA LA SIMULACIÓN DEL CRÉDITO</h5>
		    </div>

		    <div class="row col-md-12 mt-2 pl-0 pr-0">

		        <form class="col-md-12 pl-0 pr-0" 
		              method="POST">

		            @csrf

		            <div class="form-row col-md-12">

		                <div class="col-md-6">
		                    <label>Monto solicitado</label>
		                    <input type="text" maxlength="12" id="valorPrestamo" name="valorPrestamo" class="form-control" value="{{ old('valorPrestamo') }}">
		                </div>

		                <div class="col-md-6">
		                    <label>Plazo en meses</label>
		                    <input type="text" maxlength="3" id="plazoCuotas" name="plazoCuotas" class="form-control" value="{{ old('plazoCuotas') }}">
		                </div>

		            </div>

			         @if ($errors->any())
			            <div class="alert alert-danger col-md-12 mt-3 mb-1 pl-3 pr-3 alert-dismissible fade show">
			                <ol class="estilo-lista-errores">
			                    @foreach ($errors->all() as $error)
			                        <li>{{ $error }}</li>
			                    @endforeach
			                </ol>
			                <button type="button" class="close" data-dismiss="alert">&times;</button>
			            </div>
			        @endif

		            <div class="form-row col-md-12 mb-4">

		                <div class="col-md-6">
		                    <label></label>
		                    <input type="submit" id="btnSimularCredito" formaction="{{ route('simulador.screen') }}" value="Generar tabla de pagos" name="btnSimularCredito" class="form-control btn btn-dark">
		                </div>

		                <div class="col-md-6">
		                    <label></label>
		                    <input type="submit" id="btnCalcularCuota" formaction="{{ route('simulador.cuota') }}" value="Calcular cuota mensual" name="btnCalcularCuota" class="form-control btn btn-dark">
		                </div>

		            </div>
		            
		        </form>

		    </div>
	</div>

@endsection

