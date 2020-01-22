@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')
	
	<div class="row col-md-12">
        <h5>LISTADO DE DOCUMENTOS PRESENTADOS</h5>
    </div>

    <div class="row col-md-12 mb-3 mt-3">

    	{{ $documentos->onEachSide(2)->links() }}

		<table class="table table-striped table-bordered">

			<tbody>

				<thead class="header-tabla">

					<tr>
						<th class="header-tabla-texto">Id</th>
						<th class="header-tabla-texto">Solicitud</th>
						<th class="header-tabla-texto">Archivo</th>
						<th class="header-tabla-texto">Fecha / Hora</th>
						<th class="header-tabla-texto">Revisión</th>
						<th class="header-tabla-texto">Aprobación</th>
						<th class="header-tabla-texto">Acciones</th>
					</tr>

				</thead>

				@foreach ($documentos as $fila)

				    <tr>
						
						<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>

						<td style="text-align:center;"> {{ $fila->idSolicitud }} </td>

						<td style="text-align:center;">

							<img src="{{ asset('icons/document-richtext.svg') }}" 
							     data-toggle="tooltip" data-placement="auto" data-html="true"
							     width="24" height="24"
							     title=
							     	"
							     		<p style='text-align: left;'>
								     		NOMBRE DEL ARCHIVO
								     		<br>
								     		[ {{ $fila->archivoOriginal}} ]
								     		<br>
								     		[ {{ $fila->documento}} ]
							     		</p>
							     	"
							     >							

						</td>
						
						<td style="text-align:left;"> {{ $fila->created_at }} </td>
						
						<td style="text-align:center;">

							@if ($fila->revisado == 1)
								<img src="{{ asset('icons/check-success.svg') }}" alt="Revisado" width="24" height="24" title="Revisado">
							@endif

							@if ($fila->revisado == 0)
								<img src="{{ asset('icons/info.svg') }}" alt="Sin revisar" width="24" height="24" title="Sin revisar">
							@endif

						</td>
						
						<td style="text-align:center;"> 

							@if ($fila->aprobado == 1)
								<img src="{{ asset('icons/check-success.svg') }}" alt="Aceptado" width="24" height="24" title="Aceptado">
							@endif

							@if ($fila->aprobado == 0)
								<img src="{{ asset('icons/x-danger.svg') }}" alt="Rechazado" width="24" height="24" title="Rechazado">
							@endif

							@if ($fila->aprobado == -1)
								<img src="{{ asset('icons/info.svg') }}" alt="Sin evaluar" width="24" height="24" title="Sin evaluar">
							@endif

						</td>
						
						<td style="text-align:center;">

							<button type="button" class="btn btn-link link-tabla" data-toggle="modal" data-target="#documento_{{ $fila->id }}">
								<img src="{{ asset('icons/search.svg') }}" alt="Ver documento" width="24" height="24" title="Ver documento">
							</button>

							<!-- Modal -->

							<div class="modal fade" id="documento_{{ $fila->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								
								<div class="modal-dialog" role="document">
									
									<div class="modal-content">
										
										<div class="modal-header">

											<h6 class="modal-title" id="exampleModalLabel">Id Documento [ {{ $fila->id }} ] / {{ $fila->documento }}</h6>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>

										<div class="modal-body">

											<div class="modal-body-descripcion">
												<h6 class="modal-title" id="modal_body_descripcion">
													{{ $fila->descripcionDocumento }}
												</h6>
											</div>

											@if (strtolower(pathinfo($fila->documento, PATHINFO_EXTENSION) == 'pdf'))
												<embed src="{{ asset('storage/docUsuarios') }}{{ '/' . $fila->documento }}" 
													   frameborder="0" width="100%" height="300px">
											@else
												<img src="{{ asset('storage/docUsuarios') }}{{ '/' . $fila->documento }}" 
													 class="img-fluid form-control estilo-img-previa">
											@endif

										</div>

										<div class="modal-footer">

											@if($fila->aprobado!=1)

												<button type="button" class="btn btn-success" data-dismiss="modal" onclick="location.href = '{{ action('CreditoController@documentoAprobado', [$fila->idSolicitud, $fila->id]) }}'">Aprobar</button>

											@endif

											@if($fila->aprobado!=0)

												<button type="button" class="btn btn-warning" data-dismiss="modal" onclick="location.href = '{{ action('CreditoController@documentoRechazado', [$fila->idSolicitud, $fila->id]) }}'">Rechazar</button>

											@endif

											@if($fila->aprobado!=1)

												<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.href = '{{ action('CreditoController@documentoEliminar', [$fila->idSolicitud, $fila->id]) }}'">Eliminar</button>

											@endif
											
										</div>

									</div>

								</div>

							</div>

						</td>

					</tr>
				
				@endforeach


			</tbody>

		</table>

	</div>

@endsection