@include('tablaPagos')

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
        <link rel="icon" href="{{ asset('prestamos2/img/core-img/favicon.ico') }}">

        <!-- Stylesheet -->
        <link rel="stylesheet" href="{{ asset('prestamos2/style.css')  }}">
        <link rel="stylesheet" href="{{ asset('prestamos2/myStyle.css')  }}">
    </head>

    <body>
            <div>
                @yield('liquidador')
            </div>
        
       <script src="{{ asset('prestamos2/js/jquery/jquery-2.2.4.min.js')  }}"></script>
        <!-- Popper js -->
        <script src="{{ asset('prestamos2/js/bootstrap/popper.min.js')  }}"></script>
        <!-- Bootstrap js -->
        <script src="{{ asset('prestamos2/js/bootstrap/bootstrap.min.js')  }}"></script>
        <!-- All Plugins js -->
        <script src="{{ asset('prestamos2/js/plugins/plugins.js')  }}"></script>
        <!-- Active js -->
        <script src="{{ asset('prestamos2/js/active.js')  }}"></script>
        <!-- jQuery-2.2.4 js -->
    </body>

</html>
