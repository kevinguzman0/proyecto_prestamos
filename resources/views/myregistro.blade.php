@include('encabezado')
@include('auth.register')
@include('slider')
@include('footer')

<main>
	@yield('encabezado')
</main>

<div>
	@yield('content')
</div>

<div>
	@yield('myslider')
</div>

<div>
	@yield('footer')
</div>