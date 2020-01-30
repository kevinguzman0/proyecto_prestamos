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

	    @if($paginacion == 'si')

    		{{ $documentos->onEachSide(5)->links() }}

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

						    	<input type="text" name="filtro" class="form-control" placeholder="escriba texto a buscar...">

						  		<div class="input-group-append">

							      	<button class="btn btn-dark" type="submit" name="btnBuscar"  formaction="{{ action('GeneralController@buscadorDocumentos') }}">

							        	Buscar

							      	</button>

							    </div>

						    </div>

						    <div class="col-md-2">

						      	<input type="submit" value="Mostrar todos" name="btnMostrarTodos" formaction="{{ action('GeneralController@todosDocumentos') }}" class="form-control btn btn-success">

						    </div>

			            </div>

					</form>

					<form class="col-md-12 padding-form" method="POST">

			            @csrf

					    <div class="form-row col-md-12 padding-form">

					    	@isset($idDocumentos)

							    <div class="col-md-2">

							    	<label class="label-margin">Id Documento</label>
							      	<select class="form-control" id="cboIdDocumentos" name="cboIdDocumentos">
							      	
								      	<option value="-1">Todos</option>
								      	@foreach ($idDocumentos as $item)
									        <option value="{{ $item->id }}">{{ $item->id }}</option>
									    @endforeach

							      	</select>

							    </div>

						    @endisset

						  	@isset($cboIdSolicitud)

							    <div class="col-md-2">

							    	<label class="label-margin">Id Solicitud</label>
							      	<select class="form-control" id="cboIdSolicitud" name="cboIdSolicitud">

								      	<option value="-1">Todos</option>
								      	@foreach ($cboIdSolicitud as $item)
									        <option value="{{ $item->idSolicitud }}">{{ $item->idSolicitud }}</option>
									    @endforeach

							      	</select>

							    </div>

						    @endisset

						    <div class="col-md-2">

						    	<label class="label-margin">Proceso Documento</label>
						      	<select class="form-control" id="procesoDocumento" name="procesoDocumento">
						      	
							      	<option value="-1">Todos</option>
							      	<option value="1">Revisado</option>
							      	<option value="0">Sin revisar</option>

						      	</select>

						    </div>

						    <div class="col-md-2">

						    	<label class="label-margin">Estado Documento</label>
						      	<select class="form-control" id="estadoDocumento" name="estadoDocumento">
						      	
							      	<option value="-2">Todos</option>
							      	<option value="-1">Sin revisado</option>
							      	<option value="1">Aprobado</option>
							      	<option value="0">Rechazado</option>

						      	</select>

						    </div>

						</div>

					    <div class="form-row col-md-12 padding-form">

					    	<div class="col-md-2">

						    	<label class="label-margin">Analizado por</label>
						      	<select class="form-control" id="cboAnalizadoPor" name="cboAnalizadoPor">
						      	
							      	<option value="-1">Todos</option>
							      	@foreach ($idDocumentos as $item)
								        <option value="{{ $item->revisor->nombres }}">{{ $item->revisor->nombres }}</option>
								    @endforeach

						      	</select>

						    </div>

						    <div class="col-md-2">

						    	<label class="label-margin">Fecha de</label>
						      	<select class="form-control" id="cboFechaDe" name="cboFechaDe">
						      	
							      	<option value="created_at">Creación</option>
							      	<option value="updated_at">Modificación</option>
							      	<option value="analizadoEn">Analisis</option>

						      	</select>

						    </div>

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
					      		<input type="submit" value="Filtrar" name="btnFiltrar" formaction="{{ action('GeneralController@filtrosDocumentos') }}" class="form-control btn btn-dark boton-filtrar">

					      	</div>

						</div>
					
					</form>	

				</div>

			</div>

        </div>

        @isset($documentos)

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

		@endisset

	</div>

@endsection