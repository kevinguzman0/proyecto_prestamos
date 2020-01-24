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

                    <div class="card-header">Cambiar contraseña</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('password.update') }}">

                            @csrf

                            <div class="form-group row">

                                <label for="myPassword" class="col-md-4 col-form-label text-md-right">Su contraseña</label>

                                <div class="col-md-6">

                                    <input id="myPassword" type="password" class="form-control @error('myPassword') is-invalid @enderror" name="myPassword" required autocomplete="myPassword" autofocus>

                                    @error('myPassword')

                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>

                                    @enderror

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">

                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')

                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>

                                    @enderror

                                </div>

                            </div>

                            <div class="form-group row">

                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">

                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                </div>

                            </div>

                            <div class="form-group row mb-0">

                                <div class="col-md-6 offset-md-4">

                                    <button type="submit" class="btn btn-primary">
                                        Cambiar contraseña
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
