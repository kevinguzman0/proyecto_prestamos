@extends('plantilla')

@include('preCarga')

@include('postCarga')

@include('sideMenu')

@include('topMenu')

@section('content')

	<div class="row col-md-12" style="">

	    <div class="row col-md-12 mt-3">
	        <h4>MI PERFIL</h4>
	    </div>

	    <div class="row col-md-12 mt-2">
	    	

	        <form class="col-md-10" 
	              action="{{ route('usuario.store') }}" 
	              method="POST"
	              enctype="multipart/form-data">

	            @csrf

			    @if ($message = Session::get('success'))
			        <div class="form-row col-md-12 alert alert-success estilo-success" role="alert">
			            <p class="alert-link">{{ $message }}</p>
			        </div>
			    @endif

	            <div class="form-row">

	                <div class="col-md-9">
	                    <label class="label-margin">Email</label>
	                    <input type="text" maxlength="100" name="email" class="form-control" value="{{ old('email', Auth::user()->email ) }}">
	                </div>

	                <div class="col-md-3">
	                    <label class="label-margin">Cédula</label>
	                    <input type="text" maxlength="15" name="cedula" class="form-control" value="{{ old('cedula') }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-6">
	                    <label class="label-margin">Nombres</label>
	                    <input type="text" maxlength="100" name="nombres" class="form-control" value="{{ old('nombres') }}">
	                </div>

	                <div class="col-md-6">
	                    <label class="label-margin">Apellidos</label>
	                    <input type="text" maxlength="100" name="apellidos" class="form-control" value="{{ old('apellidos') }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-4">
	                    <label class="label-margin">Teléfono #1</label>
	                    <input type="text" maxlength="15" name="telefono1" class="form-control" value="{{ old('telefono1') }}">
	                </div>

	                <div class="col-md-4">
	                    <label class="label-margin">Teléfono #2</label>
	                    <input type="text" maxlength="15" name="telefono2" class="form-control" value="{{ old('telefono2') }}">
	                </div>

	                <div class="col-md-4">
	                    <label class="label-margin">Fecha de nacimiento</label>
	                    <input type="date" name="fechaNacimiento" class="form-control" value="{{ old('fechaNacimiento') }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-5">
	                    <label class="label-margin">Dirección</label>
	                    <input type="text" maxlength="100" name="direccion" class="form-control" value="{{ old('direccion') }}">
	                </div>

	                <div class="col-md-4">
	                    <label class="label-margin">Barrio</label>
	                    <input type="text" maxlength="100" name="barrio" class="form-control" value="{{ old('barrio') }}">
	                </div>

	                <div class="col-md-3">
	                    <label class="label-margin">Ciudad</label>
	                    <input type="text" maxlength="45" name="ciudad" class="form-control" value="{{ old('ciudad') }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-4">
	                    <label class="label-margin">Área de trabajo</label>
	                    <input type="text" maxlength="100" name="areaTrabajo" class="form-control" value="{{ old('areaTrabajo') }}">
	                </div>

	                <div class="col-md-5">
	                    <label class="label-margin">Cargo de trabajo</label>
	                    <input type="text" maxlength="100" name="cargoTrabajo" class="form-control" value="{{ old('cargoTrabajo') }}">
	                </div>

	                <div class="col-md-3">
	                    <label class="label-margin">Afiliado al fondo</label>
						<select name="afiliadoFondo" class="form-control browser-default custom-select">

							<option disabled>seleccionar</option>
							
							@if (old('afiliadoFondo') == 1)
								<option value="1" selected>Si</option>
							@else
								<option value="1">Si</option>
							@endif

							@if (old('afiliadoFondo') == 0)
								<option value="0" selected>No</option>
							@else
								<option value="0">No</option>
							@endif

						</select>
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-12">
						<div class="input-group">
							<label class="control-label label-margin">Foto Personal</label>
							<input type="file" name="foto" class="filestyle" 
								   data-text="Seleccionar" 
								   data-dragdrop="false" 
								   data-btnClass="btn-dark"
								   data-placeholder="archivo no seleccionado">
						</div>
	                </div>

	            </div>

	            <input type="hidden" readonly maxlength="20" name="idPerfilUsuario" value="1" class="form-control">

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
