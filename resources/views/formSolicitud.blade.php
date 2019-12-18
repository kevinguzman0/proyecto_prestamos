@section('solicitud')

	<form method="POST" action="{{ url ('/validarSolicitud') }}">

		@csrf

		<div class="d-flex-col align-items-center">

			<div>
	    		<input type="text" placeholder="Valor solicitado" name="monto" class="solicitud">
		    </div>

		    <div>
		    	<input type="text" placeholder="Plazo en meses" name="plazo" class="solicitud">
		    </div>

			<div>
				<input type="text" placeholder="Valor cuota quincenal" name="cuota15" class="solicitud">
			</div>
			
			<div>
				<input type="text" placeholder="Valor cuota mensual"  name="cuota30" class="solicitud">
			</div>

			<div>
				<input type="text" placeholder="Tasa de interés" name="tasa" class="solicitud">
			</div>

			<div>
				<input type="text" placeholder="ID estado" name="idEstadoSolicitud" class="solicitud">
			</div>

			<div>
				<input type="text" placeholder="ID cliente" name="idCliente" class="solicitud">
			</div>

			<div>
				<input type="submit" value="Guardar" name="btnGuardar" class="">
			</div>
			
		</div>

	</form>

@endsection