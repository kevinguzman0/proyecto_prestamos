@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="row col-md-12">
        <h5>DUCUMENTOS</h5>
    </div>

    <div class="row col-md-12 mb-3 mt-3">

		<table class="table table-striped table-bordered table-fit" style="">

			<tbody>

				<thead>
					<tr>
						<th>Id Documento</th>
						<th>Imagen</th>
						<th>Descripcion</th>
						<th>Revisado</th>
						<th>Aprobado</th>
					</tr>
				</thead>

				@foreach ($documento as $fila)

				    <tr>

						<td style="text-align:center; font-weight: bold;">{{ $fila->id }}</td>
						<td style="text-align:center;"> {{ $fila->imagen }} </td>
						<td style="text-align:right;"> {{ $fila->descripcionImagen }} </td>
						<td style="text-align:center;"> {{ $fila->revisado }} </td>
						<td style="text-align:right;"> {{ $fila->aprobado }} </td>
						
					</tr>
					
				@endforeach


			</tbody>

		</table>

		<div class="row col-md-12 mt-2">
	    	

	        <form class="col-md-10" 
	              action="{{ route('documento.nuevo') }}" 
	              method="POST"
	              enctype="multipart/form-data">

	            @csrf

			    @if ($message = Session::get('success'))
			        <div class="form-row col-md-12 alert alert-success estilo-success" role="alert">
			            <p class="alert-link">{{ $message }}</p>
			        </div>
			    @endif

	            <div class="form-row">

	                <div class="col-md-12">
						<div class="input-group">
							<label class="control-label label-margin">Adjuntar archivo</label>
							<input type="file" name="imagen" class="filestyle" 
								   data-text="Seleccionar" 
								   data-dragdrop="false" 
								   data-btnClass="btn-dark"
								   data-placeholder="archivo no seleccionado">
						</div>
	                </div>

	            </div>

	             <div class="form-row">

	                <div class="col-md-4">

	                    <label class="label-margin">Descripcion de la imagen</label>

	                    <textarea maxlength="200" name="descripcionImagen" class="form-control" value="{{ old('areaTrabajo') }}" placeholder="Escriba aqui"></textarea>
	                   
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