@include('encabezado')
@include('slider')
@include('content_home')
@include('footer')

<main>
	@yield('encabezado')
</main>

<div>
	@yield('myslider')
</div>

<div>
	@yield('content')
</div>

<div>
	@yield('footer')
</div>