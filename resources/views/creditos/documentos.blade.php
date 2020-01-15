@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="row col-md-12">
        <h5>LISTADO DE DOCUMENTOS PRESENTADOS PARA LA SOLICITUD NRO. {{ $idSolicitud }}</h5>
    </div>

    <div class="row col-md-12 mb-3 mt-3">

	    @if ($mensaje = Session::get('success'))
	        <div class="form-row col-md-12 alert alert-success estilo-success" role="alert">
	            <p class="alert-link">{{ $mensaje}} </p>
	        </div>
	    @endif

		<table class="table table-striped table-bordered table-fit" style="">

			<tbody>

				<thead>
					<tr>
						<th>Id</th>
						<th>Documento</th>
						<th>Revisión</th>
						<th>Aprobación</th>
						<th>Acciones</th>
					</tr>
				</thead>

				@foreach ($documentos as $fila)

				    <tr>
						
						<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
						<td style="text-align:left;"> {{ $fila->documento }} </td>
						
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

							<button type="button" class="btn btn-link link-tabla" data-toggle="modal" data-target="#exampleModal">
							  Ver
							</button>

							<!-- Modal -->
							<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">{{ $fila->documento }}</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-header">
							        <h6 class="modal-title" id="exampleModalLabel">{{ $fila->descripcionDocumento }}</h3>
							      </div>
							      
							      <div class="modal-body">
							        <img src="{{ asset('storage/docUsuarios') }}{{ '/' . $fila->documento }}" class="img-rounded" width="304" height="236" />
							      </div>
							      <div class="modal-footer">
							        				       
							        <button type="button" class="btn btn-success" data-dismiss="modal">Aprobar</button>
							        <button type="button" class="btn btn-danger" data-dismiss="modal">Rechazar</button>
							         <button type="button" class="btn btn-warning" data-dismiss="modal">Borrar</button>
							        <button type="button" class="btn btn-dark" data-dismiss="modal">Cerrar</button>

							      </div>
							    </div>
							  </div>
							</div>

					</tr>
					
				@endforeach

			</tbody>

		</table>

	</div>

    <div class="row col-md-12 mb-3 mt-3">

		<div class="row col-md-12 mt-2">
	    	
	        <form class="col-md-10" 
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

	                    <label class="label-margin">Descripción de la imagen</label>
	                    <textarea maxlength="200" name="descripcionDocumento" class="form-control" value="{{ old('descripcionImagen') }}" placeholder="Escriba una descripción del documento que está subiendo para revisión."></textarea>
	                   
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

	            <div class="form-row mb-5">

	                <div class="col-md-12">
	                    <label></label>
	                    <input type="submit" value="Grabar" name="btnGrabarUser" class="form-control btn btn-info">
	                </div>

	            </div>
	            
	        </form>

	    </div>

	</div>

@endsection