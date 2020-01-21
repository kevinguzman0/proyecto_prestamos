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

		<table class="table table-striped table-bordered table-fit">

			<tbody>
				<thead>

					<tr>
						<th>IdUsuario</th>
						<th>Usuario</th>
						<th>Email</th>
						<th>Verificado</th>
						<th>Acciones</th>
					</tr>

				</thead>

				@foreach ($usuarios as $fila)

				    <tr>

						<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
						<td style="text-align:center; font-weight: bold;"> {{ $fila->name }} </td>
						<td style="text-align:center;"> {{ $fila->email }} </td>
						<td style="text-align:center; font-weight: bold;"> {{ $fila->email_verified_at }} </td>

						<td style="text-align:center; font-weight: bold;">

							<a href="" class="btn btn-link link-tabla" data-toggle="modal" data-target="#confirm-delete_{{ $fila->id }}">
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


							<a href="{{ route('usuario.mi.perfil') }}">
								<img src="{{ asset('icons/search.svg') }}" alt="Presentar / Ver documentos" width="24" height="24" title="Ver perfil">
							</a>

							<a href="{{ route('usuario.validar', [$fila->id]) }}">
								<img src="{{ asset('icons/unlock.svg') }}" alt="Presentar / Ver documentos" width="24" height="24" title="Validar">
							</a>
						</td>						

					</tr>
				
				@endforeach


			</tbody>

		</table>

	</div>

@endsection