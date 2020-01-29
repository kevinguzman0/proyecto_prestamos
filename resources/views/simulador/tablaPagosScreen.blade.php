@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
    <div class="row col-md-12">
        <h5>TABLA DE PAGOS PARA EL CRÉDITO</h5>
    </div>

    <div class="row col-md-12 mb-4">

        @auth

	        @if(App\User::find(Auth()->user()->id)->perfil != null) 

		        <div class="col-md-2 margenes-botones">
					<a href="{{ route('simulador.pdf') }}" class="btn btn-dark mt-2 mb-2" target="_blank">
						Generar pdf
					</a>
		        </div>

				@if(Auth()->user()->id == $idCliente)

			        <div class="col-md-2 margenes-botones">
						<form class="col-md-12 pl-0 pr-0" method="POST">

							@csrf
							
							<input type="hidden" name="monto" value="{{ $valorPrestamo }}">
							<input type="hidden" name="plazo" value="{{ $plazoCuotas }}">
							<input type="hidden" name="cuota" value="{{ $valorCuota }}">
							<input type="hidden" name="interes" value="{{ $interes }}">
							
							<input type="submit" formaction="{{ route('solicitud.nueva') }}" value="Solicitar crédito" name="btnSolicitarCredito" class="form-control btn btn-danger mt-2 mb-2">
						
						</form>
			        </div>

		        @endif

	        @else

		        <div class="form-row col-md-12 alert alert-danger estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
					Para solicitar este crédito o generarlo en archivo Pdf, primero debe llenar su información de perfil... <a href="{{ action('PerfilController@miPerfil', [Auth::user()->id]) }}" class="font-weight-bold font-italic">Haga click aquí para crear su perfil.</a>
					<button type="button" class="close" data-dismiss="alert">&times;</button>
		        </div>

		    @endif

	    @else

	        <div class="form-row col-md-12 alert alert-danger estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
				Para solicitar este crédito o generarlo en archivo Pdf, debe ingresar al sistema con sus credenciales. Sí no las tiene, debe registrarse y llenar su información de perfil... <a href="{{ route('registrarse') }}" class="font-weight-bold font-italic">Haga click aquí para registrarse y luego crear su perfil.</a>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
	        </div>

        @endauth	

    </div>

	<div class="row col-md-12 mb-3 mt-3">

		<table class="table table-striped table-bordered table-fit">

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

	</div>

@endsection
