@extends('simulador.plantillaEstilosPdf')

@section('contenidoTabla')

    <div class="table-responsive paginate_break">

		<table class="table-striped table-bordered table-condensed">

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
