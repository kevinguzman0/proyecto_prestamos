@include('encabezado')
@include('slider')
@include('solicitud')
@include('footer')

<main>
	@yield('encabezado')
</main>

<div>
	@yield('myslider')
</div>
<div>
	@yield('solicitud')
</div>
<div>
	@yield('footer')
</div>