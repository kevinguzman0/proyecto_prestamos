@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="row col-md-12">
        <h5>MI HISTORIAL DE SOLICITUDES DE CRÉDITO</h5>
    </div>

    <div class="row col-md-12 mb-3 mt-3">

		<table class="table table-striped table-bordered table-fit" style="">

			<tbody>

		        @if(App\User::find(Auth()->user()->id)->usuario != null)

					<thead>
						<tr>
							<th>Id Solicitud</th>
							<th>Fecha</th>
							<th>Monto</th>
							<th>Plazo</th>
							<th>Cuota mensual</th>
							<th>Interés</th>
							<th>Estado solicitud</th>
							<th>Acciones</th>
						</tr>
					</thead>

					@foreach ($solicitudes as $fila)

					    <tr>

							<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
							<td style="text-align:center;"> {{ Date_format($fila->created_at, "d/m/Y") }} </td>
							<td style="text-align:right;"> {{ '$' . number_format($fila->monto) }} </td>
							<td style="text-align:center;"> {{ $fila->plazo }} </td>
							<td style="text-align:right;"> {{ '$' . number_format($fila->cuota,2) }} </td>
							<td> {{ $fila->interes . '%' }} </td>
							<td> {{ $fila->estado->nombreEstado }} </td>
							<td>
								<a href="{{ route('documento.store', [$fila->id]) }}" class="btn btn-link link-tabla">Subir documentos</a>
							</td>
						</tr>
					
					@endforeach

				@else

			        <div class="form-row col-md-12 alert alert-danger estilo-success" role="alert">
			            <p class="alert-link">{{ $mensaje }}
				            <a href="{{ route('usuario.perfil') }}">Haga click aqui para ir a su perfil.
			            	</a>
		            	</p>
			        </div>

				@endif

			</tbody>

		</table>

	</div>

@endsection






