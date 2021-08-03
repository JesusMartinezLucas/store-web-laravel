<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Store</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body class="bg-gray-200">
        <nav class="p-6 bg-white flex justify-between mb-6">
            <ul class="flex items-center">
                <li>
                    <a href="" class="p-3">Inicio</a>
                </li>
                <li>
                    <a href="" class="p-3">Panel</a>
                </li>
                <li>
                    <a href="" class="p-3">Producto</a>
                </li>
            </ul>

            <ul class="flex items-center">

                @auth
                    <li>
                        <a href="" class="p-3">Jesús Martínez</a>
                    </li>
                    <li>
                        <a href="" class="p-3">Salir</a>
                    </li>
                @endauth

                @guest
                    <li>
                        <a href="" class="p-3">Iniciar sesión</a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="p-3">Registrar</a>
                    </li>
                @endguest
            </ul>
        </nav>
        @yield('content')
    </body>
</html>