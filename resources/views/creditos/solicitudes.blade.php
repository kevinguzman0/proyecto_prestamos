@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="row col-md-12">
        <h5>MI HISTORIAL DE SOLICITUDES DE CRÉDITO</h5>
    </div>

	<div class="row col-md-12 padding-form">

		<div class="col-md-2">
	        <label class="label-margin">Id Cliente</label>
	        <input type="text" name="idCliente" class="form-control font-weight-bolder" value="{{ $cliente->id }}" disabled>
	    </div>

		<div class="col-md-4">
	        <label class="label-margin">Nombre completo</label>
	        <input type="text" name="nombres" class="form-control font-weight-bolder" value="{{ $cliente->nombres }} {{ $cliente->apellidos }}" disabled>
	    </div>

		<div class="col-md-2">
	        <label class="label-margin">Cédula</label>
	        <input type="text" name="cedula" class="form-control font-weight-bolder" value="{{ $cliente->cedula }}" disabled>
	    </div>

		<div class="col-md-4">
	        <label class="label-margin">Email</label>
	        <input type="text" name="email" class="form-control font-weight-bolder" value="{{ $cliente->email }}" disabled>
	    </div>

	</div>

    <div class="row col-md-12 mb-3 mt-3">

	    @if ($mensaje = Session::get('mensajeVerde'))
	        <div class="form-row col-md-12 alert alert-success estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
	            {{ $mensaje }}
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	        </div>
	    @endif

		<table class="table table-striped table-bordered">

			<tbody>

		        @if(App\User::find(Auth()->user()->id)->usuario != null)

					<thead class="header-tabla">
						<tr>
							<th class="header-tabla-texto">Id Solicitud</th>
							<th class="header-tabla-texto">Fecha</th>
							<th class="header-tabla-texto">Monto</th>
							<th class="header-tabla-texto">Plazo</th>
							<th class="header-tabla-texto">Cuota mensual</th>
							<th class="header-tabla-texto">Interés</th>
							<th class="header-tabla-texto">Estado solicitud</th>
							<th class="header-tabla-texto">Acciones</th>
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

								@if($fila->idEstadoSolicitud<=3)
									<a href="{{ route('documentos.tabla', [$cliente->id, $fila->id]) }}">
										<img src="{{ asset('icons/upload.svg') }}" alt="Subir/Ver documentos" width="24" height="24" title="Subir/Ver documentos">
								</a>
								@endif
								
								@if($fila->idEstadoSolicitud == 1)
									<a href="{{ route('solicitud.eliminar', [$cliente->id, $fila->id]) }}" class="btn btn-link link-tabla">
										<img src="{{ asset('icons/trash.svg') }}" alt="Eliminar" width="24" height="24" title="Eliminar">
									</a>
								@endif

							</td>

						</tr>
					
					@endforeach

				@else

			        <div class="form-row col-md-12 alert alert-danger estilo-success alert-dismissible fade show" role="alert">
			            Para realizar esta consulta, primero debe llenar su información de perfil... <a href="{{ route('usuario.perfil') }}">Haga click aquí para crear su perfil. </a>
		            	<button type="button" class="close" data-dismiss="alert">&times;</button>
			        </div>

				@endif

			</tbody>

		</table>

	</div>

@endsection
