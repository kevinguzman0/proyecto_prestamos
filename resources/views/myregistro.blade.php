@include('encabezado')
@include('auth.register')
@include('footer')

<main>
	@yield('encabezado')
</main>

<div>
	@yield('content')
</div>

<div>
	@yield('footer')
</div>