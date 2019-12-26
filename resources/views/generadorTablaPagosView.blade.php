@extends('simulador')

@section('contenidoTabla')
	
    <div class="row col-md-12">
        <h5>TABLA DE PAGOS PARA EL CRÉDITO</h5>
    </div>

	<a href="{{ route('tablaPagosPdf') }}" class="btn btn-dark mt-2 mb-2" target="_blank">
		Generar pdf
	</a>

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
