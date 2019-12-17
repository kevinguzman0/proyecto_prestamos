@section('tabla')
	<style type="text/css">
		.form{
			width: 45%;
			height: 300px;
		}
		.text{
			background-color:
			width: 40%;
			margin: auto;
		}

		.valor{
			margin-top: 60px;
			border-radius: 10px;
			border-style: solid;
			border-color: #ff8c00;
			border-width: 0.5px;
			width: 30%;
			height: 40px;
			margin-left: 100px;
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
			margin-right: 100px;
			padding-left: 20px;
		}
		.plazo:hover{
			transition: 1s;
			border-color: #00983b;
		}
		.boton{
			width: 55%;
			margin: auto;
			height: 130px;
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

				<input type="submit" value="Calcular valor de la cuota" name="valorcuota" class="btn credit-btn mt-50 class_boton" style="width: 100%; margin-bottom: -30px;">

		    	<input type="submit" value="Generar tabla de pagos" name="tablapagos" class="btn credit-btn mt-50 class_boton" style="width: 100%; margin-bottom: -30px;">

			</div>
		    
		</form>
	</div>

@endsection
