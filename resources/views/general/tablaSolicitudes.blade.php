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

	     @if($paginacion == 'si')

    		{{ $solicitudes->onEachSide(2)->links() }}

		@endif    	

		<p>
			<button class="btn btn-dark" type="button" data-toggle="collapse" data-target="#seccionFiltros" aria-expanded="false" aria-controls="collapseExample">
				Ver filtros disponibles
			</button>
		</p>

        <div class="form-row col-md-12 padding-form">		

			<div class="collapse col-md-12 mb-3" id="seccionFiltros">

				<div class="card card-body">

					<form class="col-md-12 padding-form" method="POST">

			            @csrf

			            <div class="form-row col-md-12 padding-form">
			            	
						    <div class="input-group col-md-10">

						    	<input type="text" name="filtro" class="form-control" placeholder="Escriba la solicitud a buscar...">

						  		<div class="input-group-append">

							      	<button class="btn btn-dark" type="submit" name="btnBuscar"  formaction="{{ action('GeneralController@buscadorSolicitudes') }}">
							        	Buscar
							      	</button>

							    </div>

						    </div>

						    <div class="col-md-2">

						      	<input type="submit" value="Mostrar todos" name="btnMostrarTodos" formaction="{{ action('GeneralController@todosSolicitudes') }}" class="form-control btn btn-success">

						        </div>

			            </div>

					</form>

					<form class="col-md-12 padding-form" method="POST">

			            @csrf

					    <div class="form-row col-md-12 padding-form">

						  	@isset($cboEstadosSolicitudes)

							    <div class="col-md-2">

							    	<label class="label-margin">Estados de solicitudes</label>
							      	<select class="form-control" id="cboEstadosSolicitudes" name="cboEstadosSolicitudes">

								      	<option value="-1">Todos</option>
								      	@foreach ($cboEstadosSolicitudes as $item)
									        <option value="{{ $item->idEstadoSolicitud }}">{{ $item->estado->nombreEstado }}</option>
									    @endforeach

							      	</select>

							    </div>

						    @endisset

						  	@isset($idSolicitud)

							    <div class="col-md-2">

							    	<label class="label-margin">Id Solicitud</label>
							      	<select class="form-control" id="cboIdSolicitudes" name="cboIdSolicitudes">
							      	
								      	<option value="-1">Todos</option>
								      	@foreach ($idSolicitud as $item)
									        <option value="{{ $item->id }}">{{ $item->id }}</option>
									    @endforeach

							      	</select>

							    </div>

						    @endisset	

						    <div class="col-md-2">

						    	<label class="label-margin">Fecha de</label>
						      	<select class="form-control" id="cboFechaDeSolicitud" name="cboFechaDeSolicitud">
						      	
							      	<option value="created_at">Creación</option>
							      	<option value="updated_at">Modificación</option>
							      	<option value="updated_at">Análisis</option>
						      	</select>

						    </div>					 

						</div>

					    <div class="form-row col-md-12 padding-form">
						   
			                <div class="col-md-3">
			                    <label class="label-margin">Fecha inicial</label>
			                    <input type="date" name="fechaInicial" class="form-control">
			                </div>

			                <div class="col-md-3">
			                    <label class="label-margin">Fecha Final</label>
			                    <input type="date" name="fechaFinal" class="form-control">
			                </div>

							<div class="col-md-2 ml-auto">

					      		<label class="label-margin"></label>
					      		<input type="submit" value="Filtrar" name="btnFiltrar" formaction="{{ action('GeneralController@filtrosSolicitudes') }}" class="form-control btn btn-dark boton-filtrar">

					      	</div>

						</div>
					
					</form>	

				</div>

			</div>

        </div>
 
  		@isset($solicitudes)

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
							<td style="text-align:center;"> {{ $fila->interes . '%' }} </td>
							<td style="text-align:center;">

								@include('modals.datos-solicitudes')
								
								@include('modals.acciones-solicitudes')

								@include('modulos.liquidador-solicitudes')

							</td>

						</tr>
					
					@endforeach

				</tbody>

			</table>

		@endisset

	</div>

@endsection