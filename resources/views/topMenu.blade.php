@section('topMenu')

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

	    <div class="container-fluid">

	        <button type="button" id="sidebarCollapse" class="btn btn-info">
	            <i class="fas fa-align-left"></i>
	            &nbsp;
	            <span>Menú Lateral</span>
	        </button>

	        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	            <i class="fas fa-align-justify"></i>
	        </button>

	        <div class="collapse navbar-collapse" id="navbarSupportedContent">

	            <ul class="nav navbar-nav ml-auto">


					<li class="nav-item"><a href="{{ route('simulador') }}">Simulador</a></li>

		            @auth

		               &nbsp; &nbsp;
   					   <li class="nav-item"><a href="{{ route('inicio') }}">Mi perfil</a></li>

		               &nbsp; &nbsp;
		               <li class="nav-item"><a href="{{ route('salir') }}">Cerrar sesión</a></li>
		            
		            @else

		                &nbsp; &nbsp;
		                <li class="nav-item"><a href="{{ route('registrarse') }}">Regístrese</a></li>

		                &nbsp; &nbsp;
		                <li class="nav-item"><a href="{{ route('ingresar') }}">Iniciar sesión</a></li>

		            @endauth

	            </ul>

	        </div>

	    </div>

	</nav>

@endsection
