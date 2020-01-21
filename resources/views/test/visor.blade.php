@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="row col-md-12">
        <h5>TEST Y DEPURACIÓN DE LA APLICACIÓN</h5>
    </div>

    <div class="row col-md-12 mt-3">

	    @if ($mensaje = Session::get('mensajeVerde'))
	        <div class="form-row col-md-12 alert alert-success estilo-success" role="alert">
	            <p class="alert-link">{{ $mensaje }} </p>
	        </div>
	    @endif

	</div>

@endsection