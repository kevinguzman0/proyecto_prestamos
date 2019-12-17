@include('encabezado')
@include('slider')
@include('index')
@include('myliquidador')
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
		@yield('liquidador')
	</div>
</div>

<div>
	@yield('footer')
</div>