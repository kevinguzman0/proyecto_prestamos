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

		<form class="col-md-12 padding-form" method="POST">

            @csrf

            <div class="form-row col-md-12 padding-form">
            	
			    <div class="input-group col-md-10">

			    	<input type="text" name="filtro" class="form-control" placeholder="escriba texto a buscar...">

			  		<div class="input-group-append">

				      	<button class="btn btn-dark" type="submit" name="btnBuscar"  formaction="{{ action('GeneralController@buscadorPerfiles') }}">

				        	{{-- 
				        	<i class="fa fa-search"></i>
				        	--}}

				        	Buscar

				      	</button>

				    </div>

			    </div>

			    <div class="col-md-2">

			      	<input type="submit" value="Mostrar todos" name="btnMostrarTodos" formaction="{{ action('GeneralController@todosPerfiles') }}" class="form-control btn btn-warning">

			        </div>

            </div>

		</form>

		<form class="col-md-12 mb-3 padding-form" method="POST">

            @csrf

		    <div class="form-row col-md-12 padding-form">

			  	@isset($cboEstadosPerfil)

				    <div class="col-md-3">

				    	<label class="label-margin">Estados de Perfil</label>
				      	<select class="form-control" id="cboEstadosPerfil" name="cboEstadosPerfil">

					      	<option value="-1">Todos</option>
					      	@foreach ($cboEstadosPerfil as $item)
						        <option value="{{ $item->idEstadoPerfil }}">{{ $item->estado->nombreEstado }}</option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset

			  	@isset($idPerfiles)

				    <div class="col-md-3">

				    	<label class="label-margin">Id Perfil</label>
				      	<select class="form-control" id="idPerfiles" name="cboIdPerfiles">
				      	
					      	<option value="-1">Todos</option>
					      	@foreach ($idPerfiles as $item)
						        <option value="{{ $item->id }}">{{ $item->id }}</option>
						    @endforeach

				      	</select>

				    </div>

			    @endisset

				<div class="col-md-1">

		      		<label class="label-margin"></label>
		      		<input type="submit" value="Filtrar" name="btnFiltrar" formaction="{{ action('GeneralController@filtrosPerfiles') }}" class="form-control btn btn-dark boton-filtrar">

		      	</div>

			</div>
		
		</form>

		@isset($perfiles)

			<table class="table table-striped table-bordered">

				<tbody>
					
					<thead class="header-tabla">

						<tr>
							<th class="header-tabla-texto">Id</th>
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