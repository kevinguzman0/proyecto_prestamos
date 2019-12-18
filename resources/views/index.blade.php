@section('tabla')
	<style type="text/css">

		.valor{
			border-radius: 10px;
			border-style: solid;
			border-color: #ff8c00;
			border-width: 0.5px;
			width: 70%;
			height: 40px;
			padding-left: 20px;

		}
		.valor:hover{
			transition: 1s;
			border-color: #00983b;
		}

		.plazo{
			border-radius: 10px;
			border-style: solid;
			border-color: #ff8c00;
			border-width: 0.5px;
			width: 70%;
			height: 40px;
			padding-left: 20px;
		}
		
		.plazo:hover{
			transition: 1s;
			border-color: #00983b;
		}

	</style>

		<div class="d-flex newsletter-area bg-img jarallax" style="background-image: url(prestamos2/img/bg-img/6.jpg); height: 320px;">

		<form method="POST" action="{{ url ('/liquidador') }}" style="width: 100%;">
			@csrf
			<div class="">
				<div class="">
		    		<input type="text" name="valorPrestamo" placeholder="Valor del prestamo" class="valor">
			    </div>

			    <div>
			    	<input type="text" name="plazoCuotas" placeholder="Plazo de cuotas" class="plazo">
			    </div>

				<div>
					<input type="submit" value="Calcular valor de la cuota" name="btnValorCuota" class="btn credit-btn mt-50 class_boton" style="width: 80%; ">
				</div>
				
				<div>
					<input type="submit" value="Generar tabla de pagos" name="btnTablaPagos" class="btn credit-btn mt-50 class_boton" style="width: 80%;">
				</div>
			</div>    
		</form>
	</div>

@endsection
