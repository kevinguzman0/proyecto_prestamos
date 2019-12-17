@section('tabla')
	<style type="text/css">
		.form{
			width: 60%;
			height: 250px;
			margin-left: 600px;
		}
		.text{
			background-color:
			width: 50%;
			margin: auto;
		}

		.valor{
			margin-top: 40px;
			border-radius: 10px;
			border-style: solid;
			border-color: #ff8c00;
			border-width: 0.5px;
			width: 30%;
			height: 40px;
			margin-left: 130px;
			padding-left: 20px;
		}
		.valor:hover{
			transition: 1s;
			border-color: #00983b;
		}
		.plazo{
			float: right;
			margin-top: -55px;
			border-radius: 10px;
			border-style: solid;
			border-color: #ff8c00;
			border-width: 0.5px;
			width: 30%;
			height: 40px;
			margin-right: 170px;
			padding-left: 20px;
		}
		.plazo:hover{
			transition: 1s;
			border-color: #00983b;
		}
		.boton{
			width: 80%;
			margin: auto;
		}


	</style>
	<div class="form newsletter-area bg-img jarallax" style="background-image: url(prestamos2/img/bg-img/6.jpg);">
		<form method="POST" action="{{ url ('/liquidador') }}">
			@csrf
			<div class="text">

				<p>
		    	<input type="text" name="valorDePrestamo" placeholder="Valor del prestamo" class="valor">
			    </p>

			    <p>
			    	<input type="text" name="plazoEnCuotas" placeholder="Plazo de cuotas" class="plazo">
			    </p>

			</div>
		    
			<div class="boton">

				<input type="submit" value="Calcular valor de la cuota" name="valorcuota" class="btn credit-btn mt-50 class_boton" style="width: 45%;">

		    	<input type="submit" value="Generar tabla de pagos" name="tablapagos" class="btn credit-btn mt-50 class_boton" style="margin-left: 20px; width: 45%;">

			</div>
		    
		</form>
	</div>

@endsection
