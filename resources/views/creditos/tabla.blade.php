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
					<th>Solicitud Nro</th>
					<th>Monto</th>
					<th>Plazo</th>
					<th>Cuota quincenal</th>
					<th>Cuota mensual</th>
					<th>Tasa de interés</th>
					<th>Estado solicitud</th>
				</tr>
			</thead>

			<tbody>

				@foreach ($solicitudes as $solicitud)

				    <tr>

						<td style="text-align:center; font-weight: bold;">{{ $solicitud->id }}</td>
						<td> {{ $solicitud->monto }} </td>
						<td> {{ $solicitud->plazo }} </td>
						<td> {{ $solicitud->cuota15 }} </td>
						<td> {{ $solicitud->cuota30 }} </td>
						<td> {{ $solicitud->tasa }} </td>
						<td> {{ App\Solicitud::find($solicitud->id)->estado->nombreEstado }} </td>

					</tr>
				
				@endforeach

			</tbody>

		</table>

	</div>

@endsection






