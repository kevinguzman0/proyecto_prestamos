@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="row col-md-12">

	    <div class="row col-md-12 mt-3">
	        <h4>MI INFORMACIÓN DE PERFIL</h4>
	    </div>

	    <div class="row col-md-12 mt-2">

	        <form class="col-md-12" 
	              action="{{ route('usuario.perfil') }}" 
	              method="POST"
	              enctype="multipart/form-data">

	            @csrf

			    @if ($mensaje = Session::get('mensajeVerde'))
			        <div class="form-row col-md-12 alert alert-success estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
			            {{ $mensaje }}
			            <button type="button" class="close" data-dismiss="alert">&times;</button>
			        </div>
			    @endif

	            <div class="form-row">

	                <div class="col-md-1">
	                    <label class="label-margin">ID</label>
	                    <input type="text" name="id" class="form-control" value="{{ $usuario->id }}" disabled>
	                </div>

	                <div class="col-md-3">
	                    <label class="label-margin">Creado en</label>
	                    <input type="text" name="created_at" class="form-control" value="{{ $usuario->created_at }}" disabled>
	                </div>

	                <div class="col-md-3">
	                    <label class="label-margin">Última modificación</label>
	                    <input type="text" name="updated_at" class="form-control" value="{{ $usuario->updated_at }}" disabled>
	                </div>

	                <div class="col-md-5">
	                    <label class="label-margin">Email</label>
	                    <input type="text" maxlength="100" name="email" class="form-control" value="{{ $usuario->email }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-3">
	                    <label class="label-margin">Cédula</label>
	                    <input type="text" maxlength="15" name="cedula" class="form-control" value="{{ $usuario->cedula }}">
	                </div>

	                <div class="col-md-5">
	                    <label class="label-margin">Nombres</label>
	                    <input type="text" maxlength="100" name="nombres" class="form-control" value="{{ $usuario->nombres }}">
	                </div>

	                <div class="col-md-4">
	                    <label class="label-margin">Apellidos</label>
	                    <input type="text" maxlength="100" name="apellidos" class="form-control" value="{{ $usuario->apellidos }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-4">
	                    <label class="label-margin">Teléfono #1</label>
	                    <input type="text" maxlength="15" name="telefono1" class="form-control" value="{{ $usuario->telefono1 }}">
	                </div>

	                <div class="col-md-4">
	                    <label class="label-margin">Teléfono #2</label>
	                    <input type="text" maxlength="15" name="telefono2" class="form-control" value="{{ $usuario->telefono2 }}">
	                </div>

	                <div class="col-md-4">
	                    <label class="label-margin">Fecha de nacimiento</label>
	                    <input type="date" name="fechaNacimiento" class="form-control" value="{{ $usuario->fechaNacimiento }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-5">
	                    <label class="label-margin">Dirección</label>
	                    <input type="text" maxlength="100" name="direccion" class="form-control" value="{{ $usuario->direccion }}">
	                </div>

	                <div class="col-md-4">
	                    <label class="label-margin">Barrio</label>
	                    <input type="text" maxlength="100" name="barrio" class="form-control" value="{{ $usuario->barrio }}">
	                </div>

	                <div class="col-md-3">
	                    <label class="label-margin">Ciudad</label>
	                    <input type="text" maxlength="45" name="ciudad" class="form-control" value="{{ $usuario->ciudad }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-4">
	                    <label class="label-margin">Área de trabajo</label>
	                    <input type="text" maxlength="100" name="areaTrabajo" class="form-control" value="{{ $usuario->areaTrabajo }}">
	                </div>

	                <div class="col-md-5">
	                    <label class="label-margin">Cargo de trabajo</label>
	                    <input type="text" maxlength="100" name="cargoTrabajo" class="form-control" value="{{ $usuario->cargoTrabajo }}">
	                </div>

	                <div class="col-md-3">
	                    <label class="label-margin">Afiliado al fondo</label>
						<select name="afiliadoFondo" class="form-control browser-default custom-select">

							<option disabled>seleccionar</option>
							
							@if (old('afiliadoFondo', $usuario->afiliadoFondo) == 1)
								<option value="1" selected>Si</option>
							@else
								<option value="1">Si</option>
							@endif

							@if (old('afiliadoFondo', $usuario->afiliadoFondo) == 0)
								<option value="0" selected>No</option>
							@else
								<option value="0">No</option>
							@endif

						</select>
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-8">
						<div class="input-group">
							<label class="control-label label-margin">Foto Personal</label>
							<input type="file" name="foto" class="filestyle"
								   data-text="Seleccionar" 
								   data-dragdrop="false" 
								   data-btnClass="btn-dark"
								   data-placeholder="archivo no seleccionado">
						</div>
	                </div>

	                <div class="col-md-4">
			            @if (!empty($usuario->foto))

							<!-- 

								Comando necesario para que la ubicación storage en public, permita ver imágenes subidas a dicha ubicación. Con el siguiente comando se crea un link simbólico.

								php artisan storage:link 

							-->

							<label class="control-label label-margin">Vista previa</label>
							<div>
								<img src="{{ asset('storage/docUsuarios') }}{{ '/' . $usuario->foto }}" width="200" class="img-fluid form-control estilo-img-previa">
							</div>
						 
						@endif
	                </div>

	            </div>

	            <input type="hidden" readonly maxlength="20" name="idPerfilUsuario" value="{{ $usuario->idPerfilUsuario }}" class="form-control">

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
	            
	            <div class="form-row mb-5">

	                <div class="col-md-12">
	                    <label></label>
	                    <input type="submit" value="Actualizar" name="btnActualizarUser" class="form-control btn btn-info">
	                </div>

	            </div>
	            
	        </form>

	    </div>

	</div>

@endsection
