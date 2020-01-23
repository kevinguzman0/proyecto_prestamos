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

                    <div class="card-header">
                        {{ __('Welcome') }} <span class="text-uppercase">{{ Auth::user()->name }}</span>
                    </div>

                    <div class="card-body">

                        @if (session('status'))

                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>

                        @endif

                        <h3>{{ __('You are logged in!') }}</h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
