@extends('plantilla')

@include('preCarga')

@include('postCarga')

@include('sideMenu')

@include('topMenu')

@section('content')

	@include('auth.login')

@endsection
