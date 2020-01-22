@section('sideMenu')

	<div class="wrapper">

	    <nav id="sidebar">

	        <div class="sidebar-header">
	            <h3>Libre Inversión</h3>
	        </div>

	        <ul class="list-unstyled components">

                <li><a href="{{ route('inicio') }}">Inicio</a></li>

	            <li>

	                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Conócenos</a>

	                <ul class="collapse list-unstyled" id="homeSubmenu">

	                    <li class="margin-submenu"><a href="#">Quiénes somos</a></li>
	                    <li class="margin-submenu"><a href="#">Cómo contactarnos</a></li>
	                    <li class="margin-submenu"><a href="#">Servicios</a></li>
	                    <li class="margin-submenu"><a href="#">Estatutos</a></li>

	                </ul>

	            </li>

	            <li><a href="{{ route('simulador') }}">Simulador</a></li>

	            <li>

	                <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Reportes</a>

	                <ul class="collapse list-unstyled" id="homeSubmenu2">

	                    <li class="margin-submenu">
	                    	<a href="{{ route('usuarios.tabla') }}">Usuarios registrados</a>
	                    </li>

	                    <li class="margin-submenu">
	                    	<a href="{{ route('perfiles.tabla') }}">Perfiles de usuario</a>
	                    </li>

	                    <li class="margin-submenu">
	                    	<a href="{{ route('solicitudes.tabla') }}">Solicitudes de crédito</a>
	                    </li>
	                    
	                    <li class="margin-submenu">
	                    	<a href="{{ route('documentos.tabla') }}">Documentos presentados</a>
	                    </li>

	                </ul>

	            </li>

                @guest

                    @if (Route::has('register'))

                        <li>
                            <a href="{{ route('registrarse') }}">{{ __('Register') }}</a>
                        </li>

                    @endif

                    <li>
                        <a href="{{ route('ingresar') }}">{{ __('Login') }}</a>
                    </li>

	            @else

                    <li class="dropdown">

 		                <a href="#sidebarDropdown" role="button" data-toggle="collapse" aria-expanded="false" aria-haspopup="true" class="dropdown-toggle user-menu" v-pre>{{ Auth::user()->name }} <span class="caret"></span></a>

		                <ul class="collapse list-unstyled" id="sidebarDropdown">

	                        
		                	<li class="margin-submenu">
		                        <a href="{{ action('PerfilController@miPerfil', [Auth::user()->id]) }}">
		                            Mi perfil
		                        </a>
		                    </li>

		                    <li class="margin-submenu">
		                		 <a href="{{ action('CreditoController@misSolicitudes', [Auth::user()->id]) }}">
		                            Mis solicitudes
		                        </a>
		                	</li>

		                	<li class="margin-submenu">

								<a href="{{ route('salir') }}">
                                	{{ __('Logout') }}
                            	</a>

		                	</li>

		                </ul>

                    </li>

                @endguest

	        </ul>

	    </nav>

	</div>

@endsection