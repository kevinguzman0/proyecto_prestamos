@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">
        <h5>LISTADO GENERAL DE PERFILES</h5>
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

    	{{--  
    	{{ $perfiles->onEachSide(2)->links() }}
		--}}

	    <div class="row col-md-12 mb-3 mt-3">

	        <form class="col-md-12" 
	              method="POST">

	            @csrf

	            <div class="col-md-10">
                    <label class="label-margin">Filtro</label>
                    <input type="text" name="filtro" value="{{ old('filtro') }}" class="form-control" placeholder="escriba los caracteres.">
                </div>
			
	            <div class="col-md-2">
                    <label></label>
                    <input type="submit" value="Buscar" name="btnBuscar" formaction="{{ action('GeneralController@buscadorPerfiles') }}" class="form-control btn btn-warning">
                </div>

				<div class="col-md-2">
					<label></label>
					<input type="submit" value="Mostrar todos" name="btnMostrarTodos" formaction="{{ action('GeneralController@todosPerfiles') }}" class="form-control btn btn-dark">
				</div>

			</form>

	    </div>

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