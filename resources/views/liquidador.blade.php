@include('encabezado')
@include('slider')
@include('index')
@include('tablaPagos')
@include('footer')

<main>
	@yield('encabezado')
</main>

<div>
	@yield('myslider')
</div>

<div class="d-flex flex-row" style="width: 100%;">
	<div class="d-flex flex-col" style="width: 30%;">
		<div class="d-flex flex-col" style="width: 100%;">
			@yield('tabla')
		</div>
		<div class="" style="width: 100%;">
			x
		</div>
	</div>

	<div class="justify-content-center" style="width: 70%;">
		<a href="{{ url ('/pdf') }}" class="btn credit-btn mt-50 class_boton">Generar pdf</a>
		@yield('liquidador')
	</div>
</div>

<div>
	@yield('footer')
</div>