@include('encabezado')
@include('slider')
@include('index')
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
	</div>
</div>

<div>
	@yield('footer')
</div>