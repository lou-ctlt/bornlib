<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bornlib') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href=" {{ asset('css/app.css') }}" />
@yield('CSS')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app2.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
            <img class="m-3"src="{{asset('storage/img/logo-voiture-electrique.jpg')}}" alt="voiture">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h1>BORN'LIB</h1>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <h5 class="navbar-nav mr-auto text-justify">
                    Trouvez (ou mettez à disposition) une borne de recharge sur Bordeaux & sa CUB
                    </h5>
                    

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li>
                                <a type="button" class="nav-link btn btn-outline-success mx-3" href="{{ route('login') }}">Se connecter</a>
                            </li>     

                        @if (Route::has('register'))        
                            <li class="nav-item">  
                               <a type="button" class="nav-link btn btn-success mx-3 text-white " href="{{ route('register') }}">S' inscrire</a>
                            </li>
                            
                        @endif

                            
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        <footer class="bg-white text-center">
        <img class="w-10"src="{{asset('storage/img/logo-voiture-electrique.jpg')}}" alt="voiture">
        Mentions Légales - Contact - Copyright TEAM XXX
        <img class="w-10"src="{{asset('storage/img/logo-voiture-electrique.jpg')}}" alt="voiture">
        
        </footer>
    </div>

    <script src="{{ asset('js/app2.js') }}" defer></script>
    <script src="{{ asset('js/form.js') }}" defer></script>
</body>
@yield('JS')

</html>
