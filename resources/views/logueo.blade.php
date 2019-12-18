@include('encabezado')
@include('auth.login')
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