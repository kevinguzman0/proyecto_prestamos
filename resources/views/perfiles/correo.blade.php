@extends('plantillas.base.plantilla')

@include('plantillas.base.preCarga')

@include('plantillas.base.postCarga')

@include('plantillas.base.sideMenu')

@include('plantillas.base.topMenu')

@section('content')

	<div class="row col-md-12"> <h5>ENVIAR CORREO A CLIENTE</h5> </div>

	<div class="form-row col-md-12 padding-form">

        <form class="col-md-12" 
              action="{{ route('enviar.correo', [$datosCliente->id]) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="form-row col-md-12 padding-form">
            	<div class="col-md-5">
                    <label class="label-margin">Enviar a</label>
                    <input type="text" maxlength="80" name="enviar_a" class="form-control" value="{{ $datosCliente->email }}" disabled>
				</div>
                <div class="col-md-7">
                    <label class="label-margin">Asunto</label>
                    <input type="text" maxlength="80" name="asunto" class="form-control">
                </div>
            </div>

            <div class="form-row col-md-12 padding-form">
            	<div class="col-md-12">
                	<label class="label-margin">Mensaje</label>
                	<textarea maxlength="200" name="mensaje" class="form-control" placeholder="Escriba el mensaje a enviar..."></textarea>
            	</div>
            </div>

            <div class="form-row col-md-12 mb-5 padding-form">

            	<div class="col-md-6">
		            <label></label>
		            <input type="submit" value="Enviar" name="btnEnviarCorreo" class="form-control btn btn-info">
            	</div>
            	
            	<div class="col-md-6">
		            <label></label>
                    <button type="button" class="form-control btn btn-dark" onclick="location.href = '{{ route('perfiles.tabla') }}'">Regresar</button>
            	</div>

            </div>
            
        </form>

	</div>



@endsection
