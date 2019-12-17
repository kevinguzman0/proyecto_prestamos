@section('liquidador')

	<table class="table table-striped table-condensed table-responsive table-bordered">

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

			@foreach ($listapagos as $fila)

				<tr>

					<td> {{ $fila['cuota'] }} </td>
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