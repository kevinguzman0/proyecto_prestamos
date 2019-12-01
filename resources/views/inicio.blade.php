@include('encabezado')
@include('content_home')
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