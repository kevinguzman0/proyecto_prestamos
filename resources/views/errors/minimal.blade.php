@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

    <div class="flex-center position-ref full-height">
        <div class="code">
            @yield('code')
        </div>

        <div class="message" style="padding: 10px;">
            @yield('message')
        </div>
    </div>
        
@endsection

        
