@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="row col-md-12">
        <h5>HISTORIAL DE DOCUMENTOS PRESENTADOS</h5>
    </div>

	<div class="row col-md-12 padding-form">

		<div class="col-md-2">
	        <label class="label-margin">Id Solicitud</label>
	        <input type="text" name="idSolicitud" class="form-control font-weight-bolder" value="{{ $idSolicitud }}" disabled>
	    </div>

		<div class="col-md-2">
	        <label class="label-margin">Id Cliente</label>
	        <input type="text" name="idCliente" class="form-control font-weight-bolder" value="{{ $perfil->id }}" disabled>
	    </div>

		<div class="col-md-5">
	        <label class="label-margin">Nombre completo</label>
	        <input type="text" name="nombres" class="form-control font-weight-bolder" value="{{ $perfil->nombres }} {{ $perfil->apellidos }}" disabled>
	    </div>

	    <div class="col-md-3">
	        <label class="label-margin">Cédula</label>
	        <input type="text" name="cedula" class="form-control font-weight-bolder" value="{{ $perfil->cedula }}" disabled>
	    </div>

	</div>

    <div class="row col-md-12 mt-3">

		@isset($mensajeVerde)
			<div class="form-row col-md-12 alert alert-success estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
	            {{ $mensajeVerde }}
	            <button type="button" class="close" data-dismiss="alert">&times;</button>
	        </div>
		@endisset

		<table class="table table-striped table-bordered">

			<tbody>

				<thead class="header-tabla">
					<tr>
						<th class="header-tabla-texto">Id Documento</th>
						<th class="header-tabla-texto">Archivo</th>
						<th class="header-tabla-texto">Fecha / Hora</th>
						<th class="header-tabla-texto">Revisión</th>
						<th class="header-tabla-texto">Aprobación</th>
						<th class="header-tabla-texto">Analizado por</th>
						<th class="header-tabla-texto">Analizado en</th>
						<th class="header-tabla-texto">Acciones</th>
					</tr>
				</thead>

				@foreach ($documentos as $fila)

				    <tr>
						
						<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>

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
						
						<td class="estilo-celda-fecha"> {{ $fila->created_at }} </td>
						
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
						
						<td class="estilo-celda-fecha"> 

							@if($fila->idAnalizadoPor != null)
								<a class="btn btn-link font-weight-bold link-tabla" href="{{ action('PerfilController@miPerfil', [$fila->idAnalizadoPor]) }}">
									{{ $fila->idAnalizadoPor }} 
								</a>
							@else
								<span class="estilo-celda-fecha">pendiente</span>
							@endif

						</td>

						<td class="estilo-celda-fecha"> 

							@if($fila->analizadoEn != null)
								{{ $fila->analizadoEn }} 
							@else
								<span class="estilo-celda-fecha">pendiente</span>
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

											@if ((strtolower(pathinfo($fila->documento, PATHINFO_EXTENSION) == 'pdf')))
												<iframe id="pdfdoc" src="{{ asset('storage/docUsuarios') }}{{ '/' . $fila->documento }}"  width="100%" height="500px"></iframe>
											@endif

											@if (in_array(strtolower(pathinfo($fila->documento, PATHINFO_EXTENSION)), array('doc', 'docx', 'xls', 'xlsx', 'zip', 'rar', '7z')))
												<h4 class="modal-title" id="modal_body_descripcion">
													Apreciado usuario, este archivo debe ser descargado
												</h4>
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

											<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="location.href = '{{ action('CreditoController@documentoDescargar', [$fila->documento]) }}'">Descargar</button>
											
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

    <div class="form-row col-md-12 padding-form">

        <form class="col-md-12" 
              action="{{ route('documento.nuevo', [$idSolicitud]) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="form-row col-md-12 padding-form">
            	<div class="col-md-12">
					<div class="input-group">
						<label class="control-label label-margin">Adjuntar documento digital</label>
						<input type="file" name="documento" class="filestyle" 
							   data-text="Seleccionar" 
							   data-dragdrop="false" 
							   data-btnClass="btn-dark"
							   data-placeholder="archivo no seleccionado">
					</div>
				</div>
            </div>

             <div class="form-row col-md-12 padding-form">
            	<div class="col-md-12">
	                <label class="label-margin">Descripción del documento</label>
	                <textarea maxlength="200" name="descripcionDocumento" class="form-control" value="{{ old('descripcionImagen') }}" placeholder="escriba una breve descripción del contenido del documento que está subiendo para revisión..."></textarea>
            	</div>
            </div>

            <div class="form-row col-md-12 mb-5 padding-form">

	            <div class="alert alert-warning col-md-12 mt-3 mb-1 pl-3 pr-3 alert-dismissible fade show">
                	No es posible modificar documentos presentados con anterioridad. Si requiere o le piden actualizar actualizar alguno, debe proceder primero a borrarlo y luego a subirlo de nuevo. Desde ese momento el documento quedará para revisión.
                	<button type="button" class="close" data-dismiss="alert">&times;</button>
	            </div>

		         @if ($errors->any())
		            <div class="alert alert-danger col-md-12 mt-3 mb-1 pl-3 pr-3 alert-dismissible fade show">
		                <ol class="estilo-lista-errores">
		                    @foreach ($errors->all() as $error)
		                        <li>{{ $error }}</li>
		                    @endforeach
		                </ol>
		                <button type="button" class="close" data-dismiss="alert">&times;</button>
		            </div>
		        @endif

            	<div class="col-md-6">
		            <label></label>
		            <input type="submit" value="Grabar" name="btnGrabarUser" class="form-control btn btn-info">
            	</div>
            	
            	<div class="col-md-6">
		            <label></label>
		            <button type="button" class="form-control btn btn-dark" onclick="location.href = '{{ action('CreditoController@tablaSolicitudes', [$perfil->id]) }}'">Regresar</button>
            	</div>

            </div>
            
        </form>

	</div>

@endsection