@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">
        <h5>LISTADO GENERAL DE PERFILES</h5>
    </div>

    <div class="row col-md-12 mt-3">

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

    		{{ $perfiles->onEachSide(2)->links() }}

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

							      	<button class="btn btn-dark" type="submit" name="btnBuscar"  formaction="{{ action('GeneralController@buscadorPerfiles') }}">

							        	Buscar

							      	</button>

							    </div>

						    </div>

						    <div class="col-md-2">

						      	<input type="submit" value="Mostrar todos" name="btnMostrarTodos" formaction="{{ action('GeneralController@todosPerfiles') }}" class="form-control btn btn-success">

						        </div>

			            </div>

					</form>

					<form class="col-md-12 padding-form" method="POST">

			            @csrf

					    <div class="form-row col-md-12 padding-form">

					    	@isset($idPerfiles)

							    <div class="col-md-2">

							    	<label class="label-margin">Id Perfil</label>
							      	<select class="form-control" id="cboIdPerfiles" name="cboIdPerfiles">
							      	
								      	<option value="-1">Todos</option>
								      	@foreach ($idPerfiles as $item)
								      		@if($item->id != 1)
									        	<option value="{{ $item->id }}">{{ $item->id }}</option>
									        @endif
									    @endforeach

							      	</select>

							    </div>

						    @endisset

						  	@isset($cboEstadosPerfil)

							    <div class="col-md-2">

							    	<label class="label-margin">Estados de Perfil</label>
							      	<select class="form-control" id="cboEstadosPerfil" name="cboEstadosPerfil">

								      	<option value="-1">Todos</option>
								      	@foreach ($cboEstadosPerfil as $item)
									        <option value="{{ $item->idEstadoPerfil }}">{{ $item->estado->nombreEstado }}</option>
									    @endforeach

							      	</select>

							    </div>

						    @endisset

						    <div class="col-md-2">

						    	<label class="label-margin">Afiliado</label>
						      	<select class="form-control" id="afiliadoFondo" name="afiliadoFondo">
						      	
							      	<option value="-1">Todos</option>
							      	<option value="1">Si</option>
							      	<option value="0">No</option>

						      	</select>

						    </div>

						</div>

					    <div class="form-row col-md-12 padding-form">

						    <div class="col-md-2">

						    	<label class="label-margin">Fecha de</label>
						      	<select class="form-control" id="cboFechaDe" name="cboFechaDe">
						      	
							      	<option value="created_at">Creación</option>
							      	<option value="updated_at">Modificación</option>
							      	<option value="fechaNacimiento">Nacimiento</option>

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
					      		<input type="submit" value="Filtrar" name="btnFiltrar" formaction="{{ action('GeneralController@filtrosPerfiles') }}" class="form-control btn btn-dark boton-filtrar">

					      	</div>

						</div>
					
					</form>	

				</div>

			</div>

        </div>

		@isset($perfiles)

			<table class="table table-striped table-bordered">

				<tbody>
					
					<thead class="header-tabla">

						<tr>
							<th class="header-tabla-texto">Id</th>
							<th class="header-tabla-texto">Estado</th>
							<th class="header-tabla-texto">Nombres</th>
							<th class="header-tabla-texto">Apellidos</th>
							<th class="header-tabla-texto">Cédula</th>
							<th class="header-tabla-texto">Email</th>
							<th class="header-tabla-texto">Acciones</th>
						</tr>

					</thead>

					@foreach ($perfiles as $fila)

						@if(!$fila->user->hasAnyRole('administrador'))
					    
						    <tr>

								<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
								<td style="text-align:center;"> {{ $fila->estado->nombreEstado }} </td>
								<td style="text-align:left;"> {{ $fila->nombres }} </td>
								<td style="text-align:left;"> {{ $fila->apellidos }} </td>
								<td style="text-align:left;"> {{ $fila->cedula }} </td>
								<td style="text-align:left;"> {{ $fila->email }} </td>

								<td style="text-align:center;">

									@include('modals.datos-perfiles')

									@include('modals.acciones-perfiles')

								</td>

							</tr>

						@endif
					
					@endforeach

				</tbody>

			</table>

		@endisset

	</div>

@endsection