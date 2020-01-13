@extends('plantilla')

@include('preCarga')

@include('postCarga')

@include('sideMenu')

@include('topMenu')

@section('content')

	<div class="row col-md-12">
        <h5>TABLA DE PAGOS DE SOLICITUDES</h5>
    </div>

    <div class="row col-md-12 mb-3 mt-3">

		<table class="table table-striped table-bordered table-fit" style="">

			<thead>
				<tr>
					<th>Solicitud</th>
					<th>Monto</th>
					<th>Plazo</th>
					<th>Cuota15</th>
					<th>Cuota30</th>
					<th>Tasa de interes</th>
					<th>Estado solicitud</th>
				</tr>
			</thead>

			<tbody>

				@foreach ($solicitudes as $soli)

				    <tr>

						<td style="text-align:center; font-weight: bold;">
							{{ $soli->id }}
						</td>
						<td> {{ $soli->monto }} </td>
						<td> {{ $soli->plazo }} </td>
						<td> {{ $soli->cuota15 }} </td>
						<td> {{ $soli->cuota30 }} </td>
						<td> {{ $soli->tasa }} </td>
						<td> {{ $soli->idEstadoSolicitud }} </td>

					</tr>
				
				@endforeach

			</tbody>

		</table>

	</div>

 
@endsection






