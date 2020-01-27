@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">
        <h5>LISTADO GENERAL DE SOLICITUDES DE CRÉDITO</h5>
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

    	{{ $solicitudes->onEachSide(2)->links() }}

		<table class="table table-striped table-bordered">

			<tbody>

				<thead class="header-tabla">

					<tr>
						<th class="header-tabla-texto">Id</th>
						<th class="header-tabla-texto">Cliente</th>
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

						<td style="text-align:center;"> 

							<a class="btn btn-link link-tabla" href="{{ action('PerfilController@miPerfil', [$fila->idCliente]) }}">
								{{ $fila->cliente->nombres }} {{ $fila->cliente->apellidos }} 
							</a>

						</td>
						<td style="text-align:right;"> {{ '$' . number_format($fila->monto) }} </td>
						<td style="text-align:center;"> {{ $fila->plazo }} </td>
						<td style="text-align:right;"> {{ '$' . number_format($fila->cuota,2) }} </td>
						<td style="text-align: center;"> {{ $fila->interes . '%' }} </td>
						<td style="text-align:center;" class="input-group">

							@include('modals.datos-solicitudes')
							
							@include('modals.acciones-solicitudes')

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

			</tbody>

		</table>

	</div>

@endsection