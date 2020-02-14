@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">Mantenimiento del sistema</div>

                    <div class="card-body alert-success">

                    	{{ $mensajeVerde }}

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
