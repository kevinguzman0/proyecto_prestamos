@section('tabla')
	<style type="text/css">
		.form{
			background-color: black;
			width: 100%;
			height: 300px;
		}
	</style>
	<div class="form">
		<form method="POST" action="{{ url ('/liquidador') }}">
			@csrf
		    <p>
		    	Valor del préstamo: 
		    	<input type="text" name="valorDePrestamo">
		    </p>

		    <p>
		    	Plazo en cuotas: 
		    	<input type="text" name="plazoEnCuotas">
		    </p>

		    <input type="submit" value="Calcular valor de la cuota" name="valorcuota">

		    <input type="submit" value="Generar tabla de pagos" name="tablapagos">

		</form>
	</div>

@endsection
