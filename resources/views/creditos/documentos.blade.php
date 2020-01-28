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
						<th class="header-tabla-texto">Revisión</th>
						<th class="header-tabla-texto">Aprobación</th>
						<th class="header-tabla-texto">Acciones</th>
					</tr>
				</thead>

				@foreach ($documentos as $fila)

				    <tr>
						
						<td style="text-align:center; font-weight: bold;"> {{ $fila->id }} </td>
												
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

							@include('modals.datos-documentos')

							@include('modals.ver-documentos')

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
							   data-placeholder="archivo no seleccionado"
							   @if(Auth()->user()->id != $perfil->id) disabled @endif>
					</div>
				</div>
            </div>

             <div class="form-row col-md-12 padding-form">
            	<div class="col-md-12">
	                <label class="label-margin">Descripción del documento</label>
	                <textarea maxlength="200" name="descripcionDocumento" class="form-control" value="{{ old('descripcionImagen') }}" placeholder="escriba una breve descripción del contenido del documento que está subiendo para revisión..."  @if(Auth()->user()->id != $perfil->id) disabled @endif></textarea>
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
		            <input type="submit" value="Grabar" name="btnGrabarUser" class="form-control btn btn-info"  @if(Auth()->user()->id != $perfil->id) disabled @endif>
            	</div>
            	
            	<div class="col-md-6">
		            <label></label>


		            @if(Auth()->user()->id == $perfil->id)

		            	<button type="button" class="form-control btn btn-dark" onclick="location.href = '{{ action('CreditoController@misSolicitudes', [$perfil->id]) }}'">Regresar</button>

		            @else

		            	<button type="button" class="form-control btn btn-dark" onclick="location.href = '{{ route('solicitudes.tabla') }}'">Regresar</button>

		            @endif
            	</div>

            </div>
            
        </form>

	</div>

@endsection