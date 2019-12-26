@section('sideMenu')

	<div class="wrapper">

	    <nav id="sidebar">

	        <div class="sidebar-header">
	            <h3>Libre Inversión</h3>
	        </div>

	        <ul class="list-unstyled components">

	            <li class="active">

	                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Inicio</a>

	                <ul class="collapse list-unstyled" id="homeSubmenu">

	                    <li><a href="#">Quiénes somos</a></li>

	                    <li><a href="#">Contáctenos</a></li>

	                    <li><a href="#">Servicios</a></li>

	                    <li><a href="#">Estatutos</a></li>

	                </ul>

	            </li>

	            <li><a href="{{ route('simulador') }}">Simulador</a></li>


	            @auth

				   <li><a href="{{ route('inicio') }}">Mi perfil</a></li>

	               <li><a href="{{ route('salir') }}">Cerrar sesión</a></li>
	            
	            @else

	                <li><a href="{{ route('registrarse') }}">Regístrese</a></li>

	                <li><a href="{{ route('ingresar') }}">Iniciar sesión</a></li>

	            @endauth

	            <!--

	                @guest
	                    <li class="nav-item">
	                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
	                    </li>
	                    @if (Route::has('register'))
	                        <li class="nav-item">
	                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
	                        </li>
	                    @endif
	                @else
	                    <li class="nav-item dropdown">
	                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
	                            {{ Auth::user()->name }} <span class="caret"></span>
	                        </a>

	                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
	                            <a class="dropdown-item" href="{{ route('logout') }}"
	                               onclick="event.preventDefault();
	                                             document.getElementById('logout-form').submit();">
	                                {{ __('Logout') }}
	                            </a>

	                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                @csrf
	                            </form>
	                        </div>
	                    </li>
	                @endguest

	            -->

	        </ul>

	    </nav>

	</div>

@endsection