@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">

        <h5>LISTADO GENERAL DE PERFILES</h5>

	    <div class="ml-auto">

	 	    @if($paginacion == 'si')

	    		{{ $perfiles->onEachSide(2)->links() }}

			@endif

		</div>

    </div>

    <div class="row col-md-12 mt-3">

    	@include('modulos.mensajes-tablas-generales')

		@include('modulos.filtros-perfiles')

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
								<td style="text-align:center;"> {{ optional($fila->estado)->nombreEstado }} </td>
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