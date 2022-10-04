<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SEF') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preload" href="{{ asset('css/colores.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('css/colores.css') }}">
    <link rel="preload" href="{{ asset('css/header.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
</head>
<body>
    <div id="app">
    
    @auth
        <header class="header_posicion">
            <nav class="posicion navbar-expand-md nav-container">
                <ul class="navbar-nav me-auto">
                    <li><a class="texto-link" href="{{ route('estudianteList') }}">Estudiantes</a></li>
                    <li><a class="texto-link" href="{{ route('profesorList') }}">Profesores</a></li>
                    <li class="session session-nav">
                        <a id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
        </header>
    @endauth

    <nav class="posadas-posicion navbar-expand-md navbar-light">
        <div class="container">
            <div class="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset ('src/img/') }}">
                </a>
            </div>

            <div class="navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login') && !Route::is('login'))
                            <li>
                                <a class="texto-link" href="{{ route('login') }}">
                                    <button type="button" class="btn-login">
                                        <span class="icono">
                                            <ion-icon name="shield-checkmark-outline"></ion-icon>
                                        </span>
                                        <span class="texto">{{ __('Iniciar Sesión') }}</span>
                                    </button>
                                </a>
                            </li>
                        @endif

                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    </div>
    
    <script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>

</body>
</html>
