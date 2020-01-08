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

	                    <li><a href="#">Quiénes somos</a></li>

	                    <li><a href="#">Cómo contactarnos</a></li>

	                    <li><a href="#">Servicios</a></li>

	                    <li><a href="#">Estatutos</a></li>

	                </ul>

	            </li>

	            <li><a href="{{ route('simulador') }}">Simulador</a></li>

                @guest

                    <li>
                        <a href="{{ route('ingresar') }}">{{ __('Login') }}</a>
                    </li>

                    @if (Route::has('register'))

                        <li>
                            <a href="{{ route('registrarse') }}">{{ __('Register') }}</a>
                        </li>

                    @endif

	            @else

                    <li class="dropdown">

 		                <a href="#sidebarDropdown" role="button" data-toggle="collapse" aria-expanded="false" aria-haspopup="true" class="dropdown-toggle" v-pre>{{ Auth::user()->name }} <span class="caret"></span></a>

		                <ul class="collapse list-unstyled" id="sidebarDropdown">

		                	<li>

								<a href="{{ route('salir') }}"
                               	   onclick="event.preventDefault();
                                            document.getElementById('logout-form-sm').submit();">
                                	{{ __('Logout') }}
                            	</a>

	                            <form id="logout-form-sm" action="{{ route('salir') }}" method="POST" style="display: none;">

	                                @csrf

	                            </form>		                		

		                	</li>

		                </ul>


                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            

                        </div>

                    </li>

                @endguest

	        </ul>

	    </nav>

	</div>

@endsection