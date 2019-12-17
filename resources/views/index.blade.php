@section('tabla')
	<style type="text/css">
		.form{
			background-color: black;
			text-align: right;
			width: 100%;
			height: 300px;
		}
	</style>
	<div class="form">
		<form method="POST" action="{{ url ('/liquidador') }}">
			@csrf
		    <p>
		    	<input type="text" name="valorDePrestamo" placeholder=" Valor del prestamo" class="valor">
		    </p>

		    <p>
		    	<input type="text" name="plazoEnCuotas" placeholder=" Plazo de cuotas">
		    </p>

		    <input type="submit" value="Calcular valor de la cuota" name="valorcuota">

		    <input type="submit" value="Generar tabla de pagos" name="tablapagos">

		</form>
	</div>

@endsection
