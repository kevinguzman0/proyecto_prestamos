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

<div>
	@yield('tabla')
</div>

<div>
	@yield('footer')
</div>