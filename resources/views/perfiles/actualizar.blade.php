@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="row col-md-12">

	    <div class="row col-md-12 mt-3">
	        <h4>INFORMACIÓN DE PERFIL</h4>
	    </div>

	    <div class="row col-md-12 mt-2">

	        <form class="col-md-12" 
	              action="{{ route('gestionar.perfil', [$perfil->id]) }}" 
	              method="POST"
	              enctype="multipart/form-data">

	            @csrf

	            <fieldset @if(Auth()->user()->id != $perfil->id) disabled @endif>

				    @if ($mensaje = Session::get('mensajeVerde'))
				        <div class="form-row col-md-12 alert alert-success estilo-success alert-dismissible fade show estilo-mensaje-verde" role="alert">
				            {{ $mensaje }}
				            <button type="button" class="close" data-dismiss="alert">&times;</button>
				        </div>
				    @endif

		            <div class="form-row">

		                <div class="col-md-1">
		                    <label class="label-margin">ID</label>
		                    <input type="text" name="id" class="form-control" value="{{ $perfil->id }}" disabled>
		                </div>

		                <div class="col-md-3">
		                    <label class="label-margin">Creado en</label>
		                    <input type="text" name="created_at" class="form-control" value="{{ $perfil->created_at }}" disabled>
		                </div>

		                <div class="col-md-3">
		                    <label class="label-margin">Última modificación</label>
		                    <input type="text" name="updated_at" class="form-control" value="{{ $perfil->updated_at }}" disabled>
		                </div>

		                <div class="col-md-5">
		                    <label class="label-margin">Email</label>
		                    <input type="text" maxlength="100" name="email" class="form-control" value="{{ $perfil->email }}">
		                </div>

		            </div>

		            <div class="form-row">

		                <div class="col-md-3">
		                    <label class="label-margin">Cédula</label>
		                    <input type="text" maxlength="15" name="cedula" class="form-control" value="{{ $perfil->cedula }}">
		                </div>

		                <div class="col-md-5">
		                    <label class="label-margin">Nombres</label>
		                    <input type="text" maxlength="100" name="nombres" class="form-control" value="{{ $perfil->nombres }}">
		                </div>

		                <div class="col-md-4">
		                    <label class="label-margin">Apellidos</label>
		                    <input type="text" maxlength="100" name="apellidos" class="form-control" value="{{ $perfil->apellidos }}">
		                </div>

		            </div>

		            <div class="form-row">

		                <div class="col-md-4">
		                    <label class="label-margin">Teléfono #1</label>
		                    <input type="text" maxlength="15" name="telefono1" class="form-control" value="{{ $perfil->telefono1 }}">
		                </div>

		                <div class="col-md-4">
		                    <label class="label-margin">Teléfono #2</label>
		                    <input type="text" maxlength="15" name="telefono2" class="form-control" value="{{ $perfil->telefono2 }}">
		                </div>

		                <div class="col-md-4">
		                    <label class="label-margin">Fecha de nacimiento</label>
		                    <input type="date" name="fechaNacimiento" class="form-control" value="{{ $perfil->fechaNacimiento }}">
		                </div>

		            </div>

		            <div class="form-row">

		                <div class="col-md-5">
		                    <label class="label-margin">Dirección</label>
		                    <input type="text" maxlength="100" name="direccion" class="form-control" value="{{ $perfil->direccion }}">
		                </div>

		                <div class="col-md-4">
		                    <label class="label-margin">Barrio</label>
		                    <input type="text" maxlength="100" name="barrio" class="form-control" value="{{ $perfil->barrio }}">
		                </div>

		                <div class="col-md-3">
		                    <label class="label-margin">Ciudad</label>
		                    <input type="text" maxlength="45" name="ciudad" class="form-control" value="{{ $perfil->ciudad }}">
		                </div>

		            </div>

		            <div class="form-row">

		                <div class="col-md-4">
		                    <label class="label-margin">Área de trabajo</label>
		                    <input type="text" maxlength="100" name="areaTrabajo" class="form-control" value="{{ $perfil->areaTrabajo }}">
		                </div>

		                <div class="col-md-5">
		                    <label class="label-margin">Cargo de trabajo</label>
		                    <input type="text" maxlength="100" name="cargoTrabajo" class="form-control" value="{{ $perfil->cargoTrabajo }}">
		                </div>

		                <div class="col-md-3">
		                    <label class="label-margin">Afiliado al fondo</label>
							<select name="afiliadoFondo" class="form-control browser-default custom-select">

								<option disabled>seleccionar</option>
								
								@if (old('afiliadoFondo', $perfil->afiliadoFondo) == 1)
									<option value="1" selected>Si</option>
								@else
									<option value="1">Si</option>
								@endif

								@if (old('afiliadoFondo', $perfil->afiliadoFondo) == 0)
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

					            @if(Auth()->user()->id == $perfil->id) 
									<label class="control-label label-margin">Foto Personal</label>
									<input type="file" name="foto" id="foto" class="filestyle"
										   data-text="Seleccionar" 
										   data-dragdrop="false" 
										   data-btnClass="btn-dark"
										   data-placeholder="archivo no seleccionado">
								@endif

							</div>
		                </div>

		                <div class="col-md-4">
				            @if (!empty($perfil->foto))

								<!-- 

									Comando necesario para que la ubicación storage en public, permita ver imágenes subidas a dicha ubicación. Con el siguiente comando se crea un link simbólico.

									php artisan storage:link 

								-->

					            @if(Auth()->user()->id == $perfil->id) 
									<label class="control-label label-margin">Vista previa</label>
								@else
									<label class="control-label label-margin">Foto de perfil</label>
								@endif

								<div>
									<img src="{{ asset('storage/fotosPerfiles') }}{{ '/' . $perfil->foto }}? {{ mt_rand(0, 100000) }}" width="200" class="img-fluid form-control estilo-img-previa" 
									name="imageProfile" id="imageProfile">
								</div>
							 
							@endif
		                </div>

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
		            
		            @if(Auth()->user()->id == $perfil->id) 

			            <div class="form-row mb-5">

			                <div class="col-md-12">
			                    <label></label>
			                    <input type="submit" value="Actualizar" name="btnActualizarUser" class="form-control btn btn-info">
			                </div>

			            </div>

		            @endif

		        </fieldset>
	            
	        </form>

	    </div>

	</div>

@endsection
