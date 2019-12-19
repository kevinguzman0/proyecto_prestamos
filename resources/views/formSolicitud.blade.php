@section('solicitud')

 <div class="row col-md-12" style="">

    <div class="row col-md-12 mt-3 ml-3">
        <h4>FORMULARIO PARA LA SOLICITUD DEL PRESTAMO</h4>
    </div>

    <div class="row col-md-12 mt-2 ml-3">

		<form method="POST" action="{{ url ('/validarSolicitud') }}">

			@csrf

			<div class="d-flex-col align-items-center">

				<div class="form-row">
					<div class="col-md-4">
						<label>Monto solicitado</label>
			    		<input type="text" maxlength="11" name="monto" class="form-control" value="{{ old('monto') }}">
				    </div>
				    <div class="col-md-4">
				    	<label>Plazo meses</label>
				    	<input type="text" maxlength="11" name="plazo" class="form-control" value="{{ old('plazo') }}">
				    </div>
				    <div class="col-md-4">
				    	<label>Tasa interes</label>
						<input type="text" maxlength="5,2" name="tasa" class="form-control" value="{{ old('tasa') }}">
					</div>
				</div>

			  <div class="form-row mb-5 justify-content-center">

          <div class="col-md-5">
              <label></label>
              <input type="submit" value="Validar tabla de pagos" name="btnEnviarUser" class="form-control">
          </div>

        </div>            

				<div class="form-row">

          <div class="col-md-6">
              <label>Valor cuota mensual</label>
              <input type="text" maxlength="13,4" name="mensual" class="form-control" value="{{ old('mensual') }}">
          </div>

          <div class="col-md-6">
              <label>Valor cuota quincenal</label>
              <input type="text" maxlength="13,4" name="quinsenal" class="form-control" value="{{ old('quinsenal') }}">
          </div>
         </div>
				<div class="form-row mb-5 justify-content-center">

          <div class="col-md-5">
              <label></label>
              <input type="submit" value="Guardar" name="btnEnviarSoli" class="form-control">
          </div>

        </div>            
				
			</div>

		</form>
	</div>
</div>

@endsection