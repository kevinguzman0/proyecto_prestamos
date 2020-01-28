@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="row col-md-12">
        <h5>HISTORIAL DE SOLICITUDES DE CRÉDITO</h5>
    </div>

	<div class="row col-md-12 padding-form">

		<div class="col-md-2">
	        <label class="label-margin">Id Cliente</label>
	        <input type="text" name="idCliente" class="form-control font-weight-bolder" value="{{ $perfil->id }}" disabled>
	    </div>

		<div class="col-md-3">
	        <label class="label-margin">Nombre completo</label>
	        <input type="text" name="nombres" class="form-control font-weight-bolder" value="{{ $perfil->nombres }} {{ $perfil->apellidos }}" disabled>
	    </div>

		<div class="col-md-2">
	        <label class="label-margin">Cédula</label>
	        <input type="text" name="cedula" class="form-control font-weight-bolder" value="{{ $perfil->cedula }}" disabled>
	    </div>

		<div class="col-md-3">
	        <label class="label-margin">Email</label>
	        <input type="text" name="email" class="form-control font-weight-bolder" value="{{ $perfil->email }}" disabled>
	    </div>

        <div class="col-md-2">
        	<label class="label-margin"></label>
            <button type="button" class="btn btn-warning boton-crear form-control" onclick="location.href = '{{ route('simulador') }}'">Crear</button>
        </div>

	</div>

    <div class="row col-md-12 mb-3 mt-3">

		@isset($mensajeVerde)
			<div class="form-row col-md-12 alert alert-success estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
	            {{ $mensajeVerde }}
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	        </div>
		@endisset

	    @if ($mensaje = Session::get('mensajeVerde'))
	        <div class="form-row col-md-12 alert alert-success estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
	            {{ $mensaje }}
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	        </div>
	    @endif
			    
		<table class="table table-striped table-bordered">

			<tbody>

		        @if(App\User::find(Auth()->user()->id)->perfil != null)

					<thead class="header-tabla">

						<tr>
							<th class="header-tabla-texto">Id</th>
							<th class="header-tabla-texto">Monto</th>
							<th class="header-tabla-texto">Plazo</th>
							<th class="header-tabla-texto">Cuota mensual</th>
							<th class="header-tabla-texto">Interés</th>
							<th class="header-tabla-texto">Acciones</th>
						</tr>

					</thead>

					@foreach ($solicitudes as $fila)

					    <tr>

							<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
							<td style="text-align:right;"> {{ '$' . number_format($fila->monto) }} </td>
							<td style="text-align:center;"> {{ $fila->plazo }} </td>
							<td style="text-align:right;"> {{ '$' . number_format($fila->cuota,2) }} </td>
							<td style="text-align:center;"> {{ $fila->interes . '%' }} </td>

							<td style="text-align:center;" class="input-group">

								@include('modals.datos-solicitudes')

								@if($fila->idEstadoSolicitud <= 3)
									<a href="{{ route('mis.documentos', [$fila->idCliente, $fila->id]) }}">
										<img src="{{ asset('icons/book.svg') }}" alt="Presentar / Ver documentos" width="24" height="24" title="Presentar / Ver documentos">
									</a>
								@endif

								@if($fila->idEstadoSolicitud <= 3)

									@include('modals.eliminar-solicitudes')

								@endif

	                            <form method="POST" action="{{ route('simulador.screen') }}">

	                                @csrf
	                                
	                                <input type="hidden" name="valorPrestamo" value="{{ $fila->monto }}">
	                                <input type="hidden" name="plazoCuotas" value="{{ $fila->plazo }}">
	                                <input type="hidden" name="interes" value="{{ $fila->interes }}">

	                                <button type="submit" class="button-image">
	                                	<img src="{{ asset('icons/document-spreadsheet.svg') }}" alt="Generar tabla de pagos" width="24" height="24" title="Generar tabla de pagos">
	                                </button>
	                                
	                            </form>

							</td>

						</tr>
					
					@endforeach

				@else

			        <div class="form-row col-md-12 alert alert-danger estilo-success alert-dismissible fade show" role="alert">
			            Para realizar esta consulta, primero debe llenar su información de perfil... <a href="{{ action('PerfilController@miPerfil', [Auth::user()->id]) }}" class="font-weight-bold font-italic">Haga click aquí para crear su perfil. </a>
		            	<button type="button" class="close" data-dismiss="alert">&times;</button>
			        </div>

				@endif

			</tbody>

		</table>

	</div>

@endsection
