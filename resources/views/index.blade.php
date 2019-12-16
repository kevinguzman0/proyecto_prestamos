<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>

	<form method="POST" action="{{ route ('operaciones') }}">
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

</body>
</html>
