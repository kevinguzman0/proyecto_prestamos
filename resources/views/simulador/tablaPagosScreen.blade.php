@extends('simulador.index')

@section('contenidoTabla')
	
    <div class="row col-md-12">
        <h5>TABLA DE PAGOS PARA EL CRÉDITO</h5>
    </div>

    <div class="row col-md-12 mb-4">

        @auth

	        <div class="col-md-2 margenes-botones">
				<a href="{{ route('simulador.pdf') }}" class="btn btn-dark mt-2 mb-2" target="_blank">
					Generar pdf
				</a>
	        </div>

	        <div class="col-md-2 margenes-botones">
				<form class="col-md-12 pl-0 pr-0" method="POST">
					@csrf
					<input type="hidden" name="monto" value="{{ $valorPrestamo }}">
					<input type="hidden" name="plazo" value="{{ $plazoCuotas }}">
					<input type="hidden" name="cuota" value="{{ $valorCuota }}">
					<input type="hidden" name="interes" value="{{ $interes }}">
					<input type="hidden" name="idEstadoSolicitud" value="1">
					<input type="hidden" name="idCliente" value="{{ Auth::user()->id }}">
					<input type="submit" formaction="{{ route('credito.store') }}" value="Solicitar crédito" name="btnSolicitarCredito" class="form-control btn btn-danger mt-2 mb-2">
				</form>
	        </div>

        @endauth	

    </div>

	<div class="row col-md-12 mb-3 mt-3">

		<table class="table table-striped table-bordered table-fit" style="">

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
