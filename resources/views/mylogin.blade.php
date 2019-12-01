@include('encabezado')
@include('auth.login')
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