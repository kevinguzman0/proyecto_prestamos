@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">

        <h5>LISTADO GENERAL DE USUARIOS REGISTRADOS</h5>

	    <div class="ml-auto">

	 	    @if($paginacion == 'si')

	    		{{ $usuarios->onEachSide(2)->links() }}

			@endif

		</div>

    </div>

    <div class="row col-md-12">

    	@include('modulos.mensajes-tablas-generales')

		@include('modulos.filtros-usuarios')

		@isset($usuarios)

			<table class="table table-striped table-bordered">

				<tbody>
					
					<thead class="header-tabla">

						<tr>
							<th class="header-tabla-texto">Id</th>
							<th class="header-tabla-texto">Usuario</th>
							<th class="header-tabla-texto">Email</th>
							<th class="header-tabla-texto">Verificado</th>
							<th class="header-tabla-texto">Estados</th>
							<th class="header-tabla-texto">Acciones</th>
						</tr>

					</thead>

					@foreach ($usuarios as $fila)

						@if(!$fila->hasRole('administrador'))

						    <tr>

								<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
								<td style="text-align:left;"> {{ $fila->name }} </td>
								<td style="text-align:left;"> {{ $fila->email }} </td>

								<td style="text-align: center;">

									@if($fila->email_verified_at == null)
										Sin verificar
									@else
										Verificado
									@endif

								</td>

								<td style="text-align: center;">

									{{ $fila->listarRoles($fila->id) }}

								</td>

								<td style="text-align:left;">

									@include('modals.datos-usuarios')
									
									@role('directivo')

										@if(Auth::user()->id != $fila->id)

											@if(!$fila->hasRole('directivo'))

												@include('modals.eliminar-usuarios')

											@endif

										@endif

									@endrole

									@role('administrador')

										@if($fila->hasRole('directivo'))

											@if($fila->contarRevisiones($fila->id) == 0)

												@include('modals.eliminar-usuarios')
											
											@endif

										@endif

									@endrole

									@if (!Auth::user()->hasRole('administrador'))

										@if(App\User::find($fila->id)->perfil != null)
											<a href="{{ action('PerfilController@miPerfil', [$fila->id]) }}">
													<img src="{{ asset('icons/person-fill.svg') }}" alt="Ver perfil" width="32" height="32" title="Ver perfil">
											</a>
										@endif

									@endif

									@role('directivo')

										@if($fila->email_verified_at == null)

											@include('modals.validar-usuarios')
											
										@endif

									@endrole

								</td>						

							</tr>
						@endif

					@endforeach

				</tbody>

			</table>

		@endisset

	</div>

@endsection