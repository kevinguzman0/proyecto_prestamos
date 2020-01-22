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

    	{{ $perfiles->onEachSide(2)->links() }}

		<table class="table table-striped table-bordered">

			<tbody>
				
				<thead class="header-tabla">

					<tr>
						<th class="header-tabla-texto">Id</th>
						<th class="header-tabla-texto">Creación</th>
						<th class="header-tabla-texto">Modificación</th>
						<th class="header-tabla-texto">Estado</th>
						<th class="header-tabla-texto">Nombres</th>
						<th class="header-tabla-texto">Apellidos</th>
						<th class="header-tabla-texto">Cédula</th>
						<th class="header-tabla-texto">Email</th>
						<th class="header-tabla-texto">Acciones</th>
					</tr>

				</thead>

				@foreach ($perfiles as $fila)

				    <tr>

						<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
						<td class="estilo-celda-fecha"> {{ $fila->created_at }} </td>
						<td class="estilo-celda-fecha"> {{ $fila->updated_at }} </td>
						<td style="text-align:center;"> {{ $fila->perfil->nombrePerfil	 }} </td>
						<td style="text-align:left;"> {{ $fila->nombres }} </td>
						<td style="text-align:left;"> {{ $fila->apellidos }} </td>
						<td style="text-align:left;"> {{ $fila->cedula }} </td>
						<td style="text-align:left;"> {{ $fila->email }} </td>

						<td style="text-align:left;">

							<a href="{{ action('PerfilController@miPerfil', [$fila->id]) }}">
								<img src="{{ asset('icons/search.svg') }}" alt="Ver perfil" width="24" height="24" title="Ver perfil">
							</a>

							<a href="{{ action('CreditoController@tablaSolicitudes', [$fila->id]) }}">
								<img src="{{ asset('icons/list-check.svg') }}" alt="Ver solicitudes" width="24" height="24" title="Ver solicitudes">
							</a>

						</td>

					</tr>
				
				@endforeach

			</tbody>

		</table>

	</div>

@endsection