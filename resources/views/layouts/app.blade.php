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
        <nav class="sticky top-0 bg-white border-b-2">
            <div class="p-6 flex flex-wrap justify-between">
            <ul class="flex flex-wrap items-center">
                <li>
                    <a href="{{ route('products.index') }}" class="p-3">Productos</a>
                    @auth
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('users.index') }}" class="p-3">Usuarios</a>
                    @endif
                    @endauth
                    @auth
                        <a href="{{ route('categories.index') }}" class="p-3">Categorías</a>
                    @endauth
                </li>
            </ul>

            <ul class="flex flex-wrap items-center">

                @auth
                    <li>
                        <a href="{{route('users.edit', auth()->user())}}" class="p-3">{{ auth()->user()->name }}</a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="p-3 inline ">
                            @csrf
                            <button type="submit">Salir</button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li>
                        <a href="{{ route('login') }}" class="p-3">Iniciar sesión</a>
                    </li>
                @endguest
            </ul>
            </div>
        </nav>
        @yield('content')
    </body>
</html>