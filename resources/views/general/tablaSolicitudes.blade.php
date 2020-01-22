@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">
        <h5>LISTADO GENERAL DE SOLICITUDES DE CRÉDITO</h5>
    </div>

    <div class="row col-md-12 mb-3 mt-3">

    	{{ $solicitudes->onEachSide(2)->links() }}

		<table class="table table-striped table-bordered">

			<tbody>

				<thead class="header-tabla">

					<tr>
						<th class="header-tabla-texto">Id</th>
						<th class="header-tabla-texto">Cliente</th>
						<th class="header-tabla-texto text-center">Fecha</th>
						<th class="header-tabla-texto">Monto</th>
						<th class="header-tabla-texto">Plazo</th>
						<th class="header-tabla-texto">Cuota mensual</th>
						<th class="header-tabla-texto">Interés</th>
						<th class="header-tabla-texto">Estado solicitud</th>
						<th class="header-tabla-texto">Acciones</th>
					</tr>

				</thead>

				@foreach ($solicitudes as $fila)

				    <tr>

						<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>

						<td style="text-align:center;"> 

							<a class="btn btn-link font-weight-bold link-tabla" href="{{ action('PerfilController@miPerfil', [$fila->idCliente]) }}">
								{{ $fila->idCliente }} 
							</a>

						</td>
						
						<td class="estilo-celda-fecha"> {{ $fila->created_at }} </td>
						<td style="text-align:right;"> {{ '$' . number_format($fila->monto) }} </td>
						<td style="text-align:center;"> {{ $fila->plazo }} </td>
						<td style="text-align:right;"> {{ '$' . number_format($fila->cuota,2) }} </td>
						<td> {{ $fila->interes . '%' }} </td>
						<td> {{ $fila->estado->nombreEstado }} </td>

						<td style="text-align:left;">

							@if($fila->idEstadoSolicitud <= 3)
								<a href="{{ route('mis.documentos', [$fila->idCliente, $fila->id]) }}">
									<img src="{{ asset('icons/book.svg') }}" alt="Presentar / Ver documentos" width="24" height="24" title="Presentar / Ver documentos">
								</a>
							@endif
							
							@if($fila->idEstadoSolicitud == 1)
								
								<a class="btn btn-link link-tabla" data-toggle="modal" data-target="#confirm-delete_{{ $fila->id }}">
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
								        <p>La eliminación de esta solicitud será irreversible. Adicionalmente, serán eliminados todos los documentos asociados que hayan sido presentados.</p>
							            <p>Desea proceder?</p>
							          </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-dark" data-dismiss="modal">Cancelar</button>
								        <button type="button" class="btn btn-danger" onclick="location.href = '{{ route('solicitud.eliminar', [$fila->idCliente, $fila->id]) }}'">Eliminar</button>
								      </div>
								    </div>
								  </div>
								</div>

							@endif

						</td>

					</tr>
				
				@endforeach


			</tbody>

		</table>

	</div>

@endsection