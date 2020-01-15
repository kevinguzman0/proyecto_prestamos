@extends('plantilla')

@include('preCarga')

@include('postCarga')

@include('sideMenu')

@include('topMenu')

@section('content')

	<div class="row col-md-12">
        <h5>MI HISTORIAL DE SOLICITUDES DE CRÉDITO</h5>
    </div>

    <div class="row col-md-12 mb-3 mt-3">

		<table class="table table-striped table-bordered table-fit" style="">

			<thead>
				<tr>
					<th>Id Solicitud</th>
					<th>Fecha</th>
					<th>Monto</th>
					<th>Plazo</th>
					<th>Cuota mensual</th>
					<th>Interés</th>
					<th>Estado solicitud</th>
				</tr>
			</thead>

			<tbody>

				@foreach ($solicitudes as $fila)

				    <tr>

						<td style="text-align:center; font-weight: bold;">{{ $fila->id }}</td>
						<td style="text-align:center;"> {{ Date_format($fila->created_at, "d/m/Y") }} </td>
						<td style="text-align:right;"> {{ '$' . number_format($fila->monto) }} </td>
						<td style="text-align:center;"> {{ $fila->plazo }} </td>
						<td style="text-align:right;"> {{ '$' . number_format($fila->cuota,2) }} </td>
						<td> {{ $fila->interes . '%' }} </td>
						<td> {{ $fila->estado->nombreEstado }} </td>

					</tr>
				
				@endforeach

			</tbody>

		</table>

	</div>

@endsection






