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

    	{{ $usuarios->onEachSide(2)->links() }}

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

				    <tr>

						<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
						<td style="text-align:left;"> {{ $fila->name }} </td>
						<td style="text-align:left;"> {{ $fila->email }} </td>

						<td style="text-align:center;">

							@include('modals.datos-usuarios')

							@if(Auth::user()->id != $fila->id)

								@include('modals.eliminar-usuarios')

							@endif

							<a href="{{ action('PerfilController@miPerfil', [$fila->id]) }}">
								@if(App\User::find($fila->id)->perfil != null)
									<img src="{{ asset('icons/eye.svg') }}" alt="Ver perfil" width="24" height="24" title="Ver perfil">
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