@section('solicitud')
<form method="POST" action="{{ url ('/solicitud') }}">
	@csrf
	<div class="d-flex-col align-items-center">
		<div class="d-flex-col">
    		<input type="text" name="monto" placeholder="Valor del prestamo" class="solicitud">
	    </div>

	    <div>
	    	<input type="text" name="plazo" placeholder="Plazo de cuotas" class="solicitud">
	    </div>

		<div>
			<input type="text" placeholder="cuotas quincenal" name="cuota15" class="solicitud">
		</div>
		
		<div>
			<input type="text" placeholder="cuotas mensual"  name="cuota30" class="solicitud">
		</div>

		<div>
			<input type="text" placeholder="Taza de interes" name="tasa" class="solicitud">
		</div>

		<div>
			<input type="text" placeholder="ID estado" name="idEstadoSolictud" class="solicitud">
		</div>

		<div>
			<input type="text" placeholder="Id cliente" name="idCliente" class="solicitud">
		</div>

		<div>
			<input type="submit" value="Guardar" name="guardar" class="">
		</div>

		
	</div>    
</form>
@endsection