@extends('plantilla')

@include('preCarga')

@include('postCarga')

@include('sideMenu')

@include('topMenu')

@section('content')

	<div class="row col-md-12" style="">

	    <div class="row col-md-12 mt-3">
	        <h4>FORMULARIO PARA REGISTRO DE INTERESADOS</h4>
	    </div>

	    <div class="row col-md-12 mt-2">

	        <form class="" 
	              action="{{ route('validarUsuario') }}" 
	              method="POST"
	              enctype="multipart/form-data">

	            @csrf

	            <div class="form-row">

	                <div class="col-md-3">
	                    <label>Cédula</label>
	                    <input type="text" maxlength="15" name="cedula" class="form-control" value="{{ old('cedula') }}">
	                </div>

	                <div class="col-md-9">
	                    <label>Email</label>
	                    <input type="text" maxlength="100" name="email" class="form-control" value="{{ old('email') }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-6">
	                    <label>Nombres</label>
	                    <input type="text" maxlength="100" name="nombres" class="form-control" value="{{ old('nombres') }}">
	                </div>

	                <div class="col-md-6">
	                    <label>Apellidos</label>
	                    <input type="text" maxlength="100" name="apellidos" class="form-control" value="{{ old('apellidos') }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-4">
	                    <label>Teléfono #1</label>
	                    <input type="text" maxlength="15" name="telefono1" class="form-control" value="{{ old('telefono1') }}">
	                </div>

	                <div class="col-md-4">
	                    <label>Teléfono #2</label>
	                    <input type="text" maxlength="15" name="telefono2" class="form-control" value="{{ old('telefono2') }}">
	                </div>

	                <div class="col-md-4">
	                    <label>Fecha de nacimiento</label>
	                    <input type="date" name="fechaNacimiento" class="form-control" value="{{ old('fechaNacimiento') }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-6">
	                    <label>Dirección</label>
	                    <input type="text" maxlength="100" name="direccion" class="form-control" value="{{ old('direccion') }}">
	                </div>

	                <div class="col-md-4">
	                    <label>Barrio</label>
	                    <input type="text" maxlength="100" name="barrio" class="form-control" value="{{ old('barrio') }}">
	                </div>

	                <div class="col-md-2">
	                    <label>Ciudad</label>
	                    <input type="text" maxlength="45" name="ciudad" class="form-control" value="{{ old('ciudad') }}">
	                </div>

	            </div>

	            <div class="form-row">

	                <div class="col-md-3">
	                    <label>Área de trabajo</label>
	                    <input type="text" maxlength="100" name="areaTrabajo" class="form-control" value="{{ old('areaTrabajo') }}">
	                </div>

	                <div class="col-md-3">
	                    <label>Cargo de trabajo</label>
	                    <input type="text" maxlength="100" name="cargoTrabajo" class="form-control" value="{{ old('cargoTrabajo') }}">
	                </div>

	                <div class="col-md-6">
	                    <label>Foto personal</label>
	                    <div class="input-group">
	                      
	                      <div class="custom-file">
	                        <input type="file" class="custom-file-input" id="foto" name="foto" aria-describedby="inputGroupFileAddon01">
	                        <label class="custom-file-label" for="foto">Seleccionar archivo</label>
	                      </div>
	                    </div>
	                </div>

	            </div>

	            <input type="hidden" readonly maxlength="20" name="idPerfilUsuario" value="1" class="form-control">

	            @if ($errors->any())

	                <div class="alert alert-danger mt-3 mb-1">

	                    <ul>

	                        @foreach ($errors->all() as $error)

	                            <li>{{ $error }}</li>
	                            
	                        @endforeach

	                    </ul>

	                </div>

	            @endif

	            <div class="form-row mb-5">

	                <div class="col-md-12">
	                    <label></label>
	                    <input type="submit" value="Registrar" name="btnRegistrarUser" class="form-control btn btn-info">
	                </div>

	            </div>
	            
	        </form>

	    </div>

	</div>

@endsection
