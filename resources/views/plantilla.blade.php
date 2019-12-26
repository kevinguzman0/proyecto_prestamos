<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Préstamos de Libre Inversión</title>

        @yield('preCarga')

    </head>

    <body>

        @yield('sideMenu')

        <div id="content">

            @yield('topMenu')

            @yield('content')

        </div>
    
        @yield('postCarga')

    </body>

</html>