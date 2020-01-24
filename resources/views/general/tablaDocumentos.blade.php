@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">
        <h5>LISTADO GENERAL DE DOCUMENTOS PRESENTADOS</h5>
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

		@isset($mensajeRojo)
			<div class="form-row col-md-12 alert alert-danger estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
	            {{ $mensajeRojo }}
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	        </div>
		@endisset

	    @if ($mensaje = Session::get('mensajeRojo'))
	        <div class="form-row col-md-12 alert alert-danger estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
	            {{ $mensaje }}
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	        </div>
	    @endif

    	{{ $documentos->onEachSide(2)->links() }}

		<table class="table table-striped table-bordered">

			<tbody>

				<thead class="header-tabla">

					<tr>
						<th class="header-tabla-texto">Id</th>
						<th class="header-tabla-texto">Solicitud</th>
						<th class="header-tabla-texto">Cliente</th>
						<th class="header-tabla-texto">Revisión</th>
						<th class="header-tabla-texto">Aprobación</th>
						<th class="header-tabla-texto">Acciones</th>
					</tr>

				</thead>

				@foreach ($documentos as $fila)

				    <tr>
						
						<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>

						<td style="text-align:center;"> 

							<a class="btn btn-link font-weight-bold link-tabla" href="{{ action('CreditoController@misSolicitudes', [$fila->solicitud->cliente->id]) }}">
								{{ $fila->idSolicitud }}  
							</a>

						</td>

						<td style="text-align:center;"> 

							<a class="btn btn-link link-tabla" href="{{ action('PerfilController@miPerfil', [$fila->solicitud->cliente->id]) }}">
								{{ $fila->solicitud->cliente->nombres }} 
								{{ $fila->solicitud->cliente->apellidos }}
							</a>

						</td>
												
						<td style="text-align:center;">

							@if ($fila->revisado == 1)
								<img src="{{ asset('icons/check-success.svg') }}" alt="Revisado" width="24" height="24" title="Revisado">
							@endif

							@if ($fila->revisado == 0)
								<img src="{{ asset('icons/info.svg') }}" alt="Sin revisar" width="24" height="24" title="Sin revisar">
							@endif

						</td>
						
						<td style="text-align:center;"> 

							@if ($fila->aprobado == 1)
								<img src="{{ asset('icons/check-success.svg') }}" alt="Aceptado" width="24" height="24" title="Aceptado">
							@endif

							@if ($fila->aprobado == 0)
								<img src="{{ asset('icons/x-danger.svg') }}" alt="Rechazado" width="24" height="24" title="Rechazado">
							@endif

							@if ($fila->aprobado == -1)
								<img src="{{ asset('icons/info.svg') }}" alt="Sin evaluar" width="24" height="24" title="Sin evaluar">
							@endif

						</td>

						<td style="text-align:center;">

							@include('modals.datos-documentos')

							@include('modals.ver-documentos')

						</td>

					</tr>
				
				@endforeach

			</tbody>

		</table>

	</div>

@endsection