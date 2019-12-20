@section('head')

    <!DOCTYPE html>

    <html lang="en">

        <head>

            <meta charset="UTF-8">
            <meta name="description" content="">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

            <!-- Title -->
            <title>Fondo de libre inversión</title>

            <!-- Favicon -->
            <link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">

            <!-- Stylesheet from @import de style.css -->

            <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')  }}">
            <link rel="stylesheet" href="{{ asset('css/classy-nav.css')  }}">
            <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')  }}">
            <link rel="stylesheet" href="{{ asset('css/animate.css')  }}">
            <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')  }}">
            <link rel="stylesheet" href="{{ asset('css/credit-icon.css')  }}">
			
            <!-- Stylesheet -->
            <link rel="stylesheet" href="{{ asset('css/style.css')  }}">
            <link rel="stylesheet" href="{{ asset('css/myStyle.css')  }}">
			
        </head>

        <body>

@show

@yield('encabezadoPdf')

@yield('content')

@section('footer')  

        <script src="{{ asset('js/jquery/jquery-2.2.4.min.js')  }}"></script>
        <!-- Popper js -->
        <script src="{{ asset('js/bootstrap/popper.min.js')  }}"></script>
        <!-- Bootstrap js -->
        <script src="{{ asset('js/bootstrap/bootstrap.min.js')  }}"></script>
        <!-- All Plugins js -->
        <script src="{{ asset('js/plugins/plugins.js')  }}"></script>
        <!-- Active js -->
        <script src="{{ asset('js/active.js')  }}"></script>
        <!-- jQuery-2.2.4 js -->

    </body>

</html>

@show

@yield('piePdf')