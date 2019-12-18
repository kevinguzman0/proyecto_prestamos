@section('liquidador')
	<a href="{{ url ('/pdf') }}" class="btn credit-btn mt-50 class_boton">Generar pdf</a>
	<table class="table table-striped table-responsive table-bordered" style="width:100% !important;">

		<thead>
			<tr>
				<th>Periodo</th>
				<th>Saldo Inicial</th>
				<th>Cuota</th>
				<th>Intereses</th>
				<th>Abono a capital</th>
				<th>Saldo de capital</th>
			</tr>
		</thead>

		<tbody>

			@foreach ($listaPagos as $fila)

				<tr>

					<td style="text-align:center; font-weight: bold;"> {{ $fila['cuota'] }} </td>
					<td> {{ $fila['saldo_inicial'] }} </td>
					<td> {{ $fila['valor_cuota'] }} </td>
					<td> {{ $fila['intereses'] }} </td>
					<td> {{ $fila['abono_k'] }} </td>
					<td> {{ $fila['saldo_k'] }} </td>

				</tr>

			@endforeach

		</tbody>

	</table>

@endsection