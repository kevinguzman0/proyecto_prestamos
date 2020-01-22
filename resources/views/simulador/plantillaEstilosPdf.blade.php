@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@section('content')
	
	<style>
		.page-break {
		    page-break-after: always;
		}
	</style>

    @yield('contenidoTabla')

@endsection