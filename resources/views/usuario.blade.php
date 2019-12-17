@include('encabezado')
@include('slider')
@include('formUser')
@include('footer')

<main>
	@yield('encabezado')
</main>

<div>
	@yield('myslider')
</div>

<div>
	@yield('miusuario')
</div>

<div>
	@yield('footer')
</div>