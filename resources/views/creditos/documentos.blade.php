@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="row col-md-8">
        <h5>LISTADO DE DOCUMENTOS PRESENTADOS</h5>
    </div>

	<div class="row col-md-2">
        <label class="label-margin">Solicitud Nro.</label>
        <input type="text" name="idSolicitud" class="form-control font-weight-bolder" value="{{ $idSolicitud }}" disabled>
    </div>

    <div class="row col-md-8 mt-3">

	    @if ($mensaje = Session::get('success'))
	        <div class="form-row col-md-12 alert alert-success estilo-success" role="alert">
	            <p class="alert-link">{{ $mensaje }} </p>
	        </div>
	    @endif

		<table class="table table-striped table-bordered">

			<tbody>

				<thead>
					<tr>
						<th>Id</th>
						<th>Archivo</th>
						<th>Fecha / Hora</th>
						<th>Revisión</th>
						<th>Aprobación</th>
						<th>Acciones</th>
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
								     		[ {{ $fila->nombreOriginal}} ]
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
						
						<td>

							<button type="button" class="btn btn-link link-tabla" data-toggle="modal" data-target="#documento_{{ $fila->id }}">
							  Ver
							</button>

							<!-- Modal -->

							<div class="modal fade" id="documento_{{ $fila->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								
								<div class="modal-dialog" role="document">
									
									<div class="modal-content">
										
										<div class="modal-header">

											<h6 class="modal-title" id="exampleModalLabel">{{ $fila->documento }}</h6>
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

												<button type="button" class="btn btn-success" data-dismiss="modal" onclick="location.href = '{{ route('aprobado.store', [$fila->id]) }}'">Aprobar</button>

											@endif

											@if($fila->aprobado!=0)

												<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="location.href = '{{ route('rechazado.store', [$fila->id]) }}'">Rechazar</button>

											@endif

											@if($fila->aprobado!=1)

												<button type="button" class="btn btn-warning" data-dismiss="modal" onclick="location.href = '{{ route('borrar.store', [$fila->id]) }}'">Borrar</button>

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

    <div class="row col-md-8">

        <form class="col-md-12 margin-form" 
              action="{{ route('documento.nuevo', [$idSolicitud]) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="form-row">
            	<div class="col-md-12">
					<div class="input-group">
						<label class="control-label label-margin">Adjuntar archivo</label>
						<input type="file" name="documento" class="filestyle" 
							   data-text="Seleccionar" 
							   data-dragdrop="false" 
							   data-btnClass="btn-dark"
							   data-placeholder="archivo no seleccionado">
					</div>
				</div>
            </div>

             <div class="form-row">
            	<div class="col-md-12">
	                <label class="label-margin">Descripción del documento</label>
	                <textarea maxlength="200" name="descripcionDocumento" class="form-control" value="{{ old('descripcionImagen') }}" placeholder="escriba una breve descripción del contenido del documento que está subiendo para revisión..."></textarea>
            	</div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mt-3 mb-1">
                    <ol class="estilo-lista-errores">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ol>
                </div>
            @endif

            <div class="alert alert-warning mt-3 mb-1">
                <span>
                	No es posible modificar documentos presentados con anterioridad. Si necesita actualizar alguno, debe primero borrarlo y luego subirlo nuevamente. Desde ese momento el documento quedará para revisar nuevamente.
                </span>
            </div>

            <div class="form-row mb-5">
            	<div class="col-md-12">
		            <label></label>
		            <input type="submit" value="Grabar" name="btnGrabarUser" class="form-control btn btn-info">
            	</div>
            </div>
            
        </form>

	</div>

@endsection