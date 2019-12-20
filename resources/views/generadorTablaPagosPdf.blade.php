@extends('bodySinContenido')

@section('head')
	@parent
@stop

@section('content')

    <div>

		<table class="table table-striped xtable-responsive table-bordered" style="width:100% !important;">

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

@section('footer')
	@parent
@stop

@section('encabezadoPdf')

    <h1>Cabecera de mi documento</h1>
    <h2>DesarrolloWeb.com</h2>

@endsection

@section('piePdf')

@endsection