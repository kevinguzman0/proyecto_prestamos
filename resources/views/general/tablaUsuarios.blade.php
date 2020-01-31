@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">
        <h5>LISTADO GENERAL DE USUARIOS REGISTRADOS</h5>
    </div>

    <div class="row col-md-12 mb-3 mt-3">

    	@include('modulos.mensajes-tablas-generales')

 	    @if($paginacion == 'si')

    		{{ $usuarios->onEachSide(2)->links() }}

		@endif

		@include('modulos.filtros-usuarios')

		@isset($usuarios)

			<table class="table table-striped table-bordered">

				<tbody>
					<thead class="header-tabla">

						<tr>
							<th class="header-tabla-texto">Id</th>
							<th class="header-tabla-texto">Usuario</th>
							<th class="header-tabla-texto">Email</th>
							<th class="header-tabla-texto">Acciones</th>
						</tr>

					</thead>

					@foreach ($usuarios as $fila)

						@if(!$fila->hasAnyRole('administrador'))

						    <tr>

								<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
								<td style="text-align:left;"> {{ $fila->name }} </td>
								<td style="text-align:left;"> {{ $fila->email }} </td>

								<td style="text-align:left;">

									@include('modals.datos-usuarios')
									
									@hasanyrole('directivo')

										@if(Auth::user()->id != $fila->id)

											@include('modals.eliminar-usuarios')

										@endif

									@endhasanyrole

									@if (!Auth::user()->hasAnyRole('administrador'))
										<a href="{{ action('PerfilController@miPerfil', [$fila->id]) }}">
											@if(App\User::find($fila->id)->perfil != null)
												<img src="{{ asset('icons/person-fill.svg') }}" alt="Ver perfil" width="32" height="32" title="Ver perfil">
											@else
												<img src="{{ asset('icons/camera.svg') }}" alt="Crear perfil" width="32" height="32" title="Crear perfil">
											@endif
										</a>
									@endif

									@hasanyrole('directivo')
										@if($fila->email_verified_at == null)

											@include('modals.validar-usuarios')
											
										@endif
									@endhasanyrole

								</td>						

							</tr>
						@endif

					@endforeach

				</tbody>

			</table>

		@endisset

	</div>

@endsection