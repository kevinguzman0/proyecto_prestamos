@include('encabezado')
@include('slider')
@include('contentHome')
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