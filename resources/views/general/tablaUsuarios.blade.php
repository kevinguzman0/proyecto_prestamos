@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">
        <h5>LISTADO USUARIOS REGISTRADOS</h5>
    </div>

    <div class="row col-md-12 mb-3 mt-3">

    	{{ $usuarios->onEachSide(2)->links() }}

		<table class="table table-striped table-bordered">

			<tbody>
				<thead class="header-tabla">

					<tr>
						<th class="header-tabla-texto">Id</th>
						<th class="header-tabla-texto text-center">Creación</th>
						<th class="header-tabla-texto text-center">Modificación</th>
						<th class="header-tabla-texto">Usuario</th>
						<th class="header-tabla-texto">Email</th>
						<th class="header-tabla-texto text-center">Verificación</th>
						<th class="header-tabla-texto">Acciones</th>
					</tr>

				</thead>

				@foreach ($usuarios as $fila)

				    <tr>

						<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
						<td class="estilo-celda-fecha"> {{ $fila->created_at }} </td>
						<td class="estilo-celda-fecha"> {{ $fila->updated_at }} </td>
						<td style="text-align:left;"> {{ $fila->name }} </td>
						<td style="text-align:left;"> {{ $fila->email }} </td>
						<td class="estilo-celda-fecha"> 

							@if($fila->email_verified_at != null)
								{{ $fila->email_verified_at }} 
							@else
								pendiente
							@endif

						</td>

						<td style="text-align:left;">

							@if(Auth::user()->id != $fila->id)
								<a data-toggle="modal" data-target="#confirm-delete_{{ $fila->id }}">
									<img src="{{ asset('icons/trash.svg') }}" alt="Eliminar" width="24" height="24" title="Eliminar">
								</a>

								<div id="confirm-delete_{{ $fila->id }}" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" aria-hidden="true">
								  <div class="modal-dialog modal-dialog-centered modal-dialog-eliminar" role="document">
								    <div class="modal-content modal-content-eliminar">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLiveLabel">Confirmar eliminación</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
								        <p>La eliminación de este usuario será irreversible.</p>
							            <p>Desea proceder?</p>
							          </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
								        <button type="button" class="btn btn-danger" onclick="location.href = '{{ route('usuario.eliminar', [$fila->id]) }}'">Eliminar</button>
								      </div>
								    </div>
								  </div>
								</div>
							@endif

							<a href="{{ action('PerfilController@miPerfil', [$fila->id]) }}">
								@if(App\User::find($fila->id)->perfil != null)
									<img src="{{ asset('icons/search.svg') }}" alt="Ver perfil" width="24" height="24" title="Ver perfil">
								@else
									<img src="{{ asset('icons/person.svg') }}" alt="Crear perfil" width="24" height="24" title="Crear perfil">
								@endif
							</a>
							
							@if($fila->email_verified_at == null)
								<a href="{{ route('usuario.validar', [$fila->id]) }}">
									<img src="{{ asset('icons/unlock.svg') }}" alt="Validar email / Desbloquear cuenta" width="24" height="24" title="Validar email / Desbloquear cuenta">
								</a>
							@endif

						</td>						

					</tr>
				
				@endforeach


			</tbody>

		</table>

	</div>

@endsection