<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Fondo de libre inversion</title>

    <!-- Favicon -->
    <link rel="icon" href="prestamos2/img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="prestamos2/style.css">
    <link rel="stylesheet" href="prestamos2/myStyle.css">
</head>

<body>
    @section('encabezado')
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
    <header class="header-area">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 d-flex justify-content-between">
                        <!-- Logo Area -->
                        <div class="logo">
                            <a href="index.html"><img src="prestamos2/img/gobernacion.png" alt="" width="300"></a>
                        </div>

                        <!-- Top Contact Info -->
                        <div class="top-contact-info d-flex align-items-center">
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="25 th Street Avenue, Los Angeles, CA"><img src="prestamos2/img/core-img/placeholder.png" alt=""> <span>Calle 19 No 13-17</span></a>
                            <a href="#" data-toggle="tooltip" data-placement="bottom" title="office@yourfirm.com"><img src="prestamos2/img/core-img/message.png" alt=""> <span>contactenos@risaralda.gov.co</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="credit-main-menu classmenu3" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container classmenu3">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between classmenu2" id="creditNav">

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav classmenu">
                                <ul>
                                    <li><a href="index.html">Inicio</a></li>
                                    <li><a href="about.html">Sobre Nosotros</a></li>
                                    <li><a href="#">Paginas</a></li>
                                    <li><a href="prestamos2/services.html">Servicios</a></li>
                                    <li><a href="prestamos2/post.html">Blog</a></li>
                                    <li><a href="prestamos2/contact.html">Contacto</a></li>
                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>

                        <!-- Contact --> 
                    <div class="contact classmenu2" style="margin-left: 170px;">
                        <a href="#" class="classmenu3"><img class="classmenu3"src="prestamos2/img/core-img/call2.png" alt="">+57 3215014816</a>
                    </div>
                        <div class="classynav" style="z-index: 100; float: right; margin-right: -300px; text-align: right;">
                            <ul>
                                @if (Route::is('registro'))
                                    <div class="top-right links">
                                        @auth
                                           <li><a href="{{ url('/logout') }}">Cerrar Sesión</a></li>
                                        @else
                                            <li><a href="{{ url('/logueo') }}">Iniciar Sesión</a></li>
                                        @endauth
                                @endif

                                @if (Route::is('logueo'))
                                    <li><a href="{{ url('/registro') }}">Registrarse</a></li>
                                @endif

                                @if (Route::is('inicio'))
                                    @auth
                                       <li><a href="{{ url('/logout') }}">Cerrar Sesión</a></li>
                                    @else
                                        <li><a href="{{ url('/logueo') }}">Iniciar Sesión</a></li>
                                    
                                    <li><a href="{{ url('/registro') }}">Registrarse</a></li>
                                    @endauth
                                @endif
                                    </div>
                            </ul>
                        </div>                       
                    </nav>
                </div>
            </div>
        </div>
    </header>
    @endsection

</body>
</html>
