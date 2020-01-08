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

                    <!-- Authentication Links -->

					<li class="nav-link"><a href="{{ route('inicio') }}">Inicio</a></li>

                    <li class="nav-link"><a href="{{ route('simulador') }}">Simulador</a></li>

                    @guest

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ingresar') }}">{{ __('Login') }}</a>
                        </li>

                        @if (Route::has('register'))

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('registrarse') }}">{{ __('Register') }}</a>
                            </li>

                        @endif

                    @else

                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle dropdown-toggle-tm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('salir') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form-tm').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form-tm" action="{{ route('salir') }}" method="POST" style="display: none;">

                                    @csrf

                                </form>

                                <a class="dropdown-item" href="{{ route('inicio') }}">
                                    Mi perfil
                                </a>
                           </div>

                        </li>

                    @endguest

	            </ul>

	        </div>

	    </div>

	</nav>

@endsection
