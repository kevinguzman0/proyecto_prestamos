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
	<div class="flex-col" style="width: 30%;">
		<div class="" style="width: 100%;">
			@yield('tabla')
		</div>
		<div class="" style="width: 100%;">
			x
		</div>
	</div>

	<div class="flex-row" style="width: 50%; margin-left: 70px; margin-top: 20px;">
		@yield('liquidador')
	</div>
</div>

<div>
	@yield('footer')
</div>