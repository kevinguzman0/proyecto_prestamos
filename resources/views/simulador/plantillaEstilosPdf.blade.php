@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@section('content')
	
	<style>
		.paginate_break{
			page-break-after: always;
			border: 0;
			margin: 0;
			padding: 0;
			}
	</style>

    @yield('contenidoTabla')

@endsection