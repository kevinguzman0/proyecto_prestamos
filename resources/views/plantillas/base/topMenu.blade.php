@section('topMenu')

	<nav class="navbar navbar-expand-lg navbar-light bg-light">

	    <div class="container-fluid">

	        <button type="button" id="sidebarCollapse" class="btn btn-info">
	            <i class="fas fa-align-left"></i>

	        </button>

	        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	            <i class="fas fa-align-justify"></i>
	        </button>

	        <div class="collapse navbar-collapse" id="navbarSupportedContent">

	            <ul class="nav navbar-nav ml-auto">

                    <!-- Authentication Links -->

                        <li class="nav-link"><a href="{{ route('inicio') }}">Inicio</a></li>

                        <li class="nav-link separacion-item-menu-top"><a href="{{ route('simulador') }}">Simulador de creditos</a></li>

                        <li class="nav-item dropdown">

                            <a id="navbarDropdown3" class="nav-link dropdown-toggle dropdown-toggle-tm user-menu separacion-item-menu-top" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Conócenos</a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown3">

                                <a class="dropdown-item" href="{{ route('quienes.somos') }}">
                                    Quienes somos
                                </a>

                                <a class="dropdown-item" href="{{ route('como.contactarnos') }}">
                                    Cómo contactarnos
                                </a>

                                <a class="dropdown-item" href="{{ route('servicios') }}">
                                    Servicios
                                </a>

                                <a class="dropdown-item" href="{{ route('estatutos') }}">
                                    Estatutos
                                </a>

                            </div>

                        </li>

                        @hasanyrole ('administrador|directivo')

                            <li class="nav-item dropdown ajuste-item-maestro-menu-top">

                                <a id="navbarDropdown2" class="nav-link dropdown-toggle dropdown-toggle-tm user-menu separacion-item-menu-top" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Maestros</a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">

                                    <a class="dropdown-item" href="{{ route('usuarios.tabla') }}">
                                        Usuarios registrados
                                    </a>

                                    <a class="dropdown-item" href="{{ route('perfiles.tabla') }}">
                                        Perfiles de usuario
                                    </a>

                                    @role ('directivo')

                                        <a class="dropdown-item" href="{{ route('solicitudes.tabla') }}">
                                            Solicitudes de crédito
                                        </a>

                                        <a class="dropdown-item" href="{{ route('documentos.tabla') }}">
                                            Documentos presentados
                                        </a>

                                    @endrole

                               </div>

                            </li>

                        @endhasanyrole

                    @guest

                        @if (Route::has('register'))

                            <li class="nav-item ajuste-item-menu-top">
                                <a class="nav-link" href="{{ route('registrarse') }}">{{ __('Register') }}</a>
                            </li>

                        @endif

                        <li class="nav-item separacion-item-menu-top">
                            <a class="nav-link" href="{{ route('ingresar') }}">{{ __('Login') }}</a>
                        </li>

                    @else

                        <li class="nav-item dropdown ajuste-item-menu-top">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle dropdown-toggle-tm user-menu" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ action('PerfilController@miPerfil', [Auth::user()->id]) }}">
                                    Mi perfil
                                </a>

                                @hasanyrole ('directivo|registrado')

                                    <a class="dropdown-item" href="{{ action('CreditoController@misSolicitudes', [Auth::user()->id]) }}">
                                        Mis solicitudes
                                    </a>

                                @endhasanyrole  
                                
                                <a class="dropdown-item" href="{{ route('cambiar.mi.password') }}">
                                    Cambiar contraseña
                                </a>

                                <a class="dropdown-item" href="{{ route('salir') }}">
                                    {{ __('Logout') }}
                                </a>

                           </div>

                        </li>

                    @endguest

	            </ul>

	        </div>

	    </div>

	</nav>

@endsection
