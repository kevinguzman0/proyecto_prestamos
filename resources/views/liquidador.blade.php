@include('encabezado')
@include('slider')
@include('myliquidador')
@include('footer')

<main>
	@yield('encabezado')
</main>

<div>
	@yield('myslider')
</div>

<div>
	@yield('liquidador')
</div>

<div>
	@yield('footer')
</div>