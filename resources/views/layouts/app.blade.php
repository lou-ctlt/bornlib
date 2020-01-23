<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- TITRE -->
    <title>{{ config('app.name', 'Bornlib') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Audiowide|Lexend+Zetta|Syncopate&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href=" {{ asset('css/app.css') }}" />
    <link rel="stylesheet" href=" {{ asset('css/cookies.css') }}" />
    <link rel="stylesheet" href=" {{ asset('css/navbar.css') }}" />
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <style>
        body{
            background-image: url('/storage/img/background.jpg');
        }
    </style>
@yield('CSS')

    <!-- FAVICON -->
    <LINK REL="SHORTCUT ICON" href="/storage/img/favicon.ico">

</head>

<!-- BODY -->
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <!-- LOGO + NOM DU SITE -->
                <img class=""src="{{ asset('storage/img/logo-voiture-electrique.jpg') }}" alt="voiture">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <h1 style="font-family: 'Syncopate', sans-serif; color:#38c172;">BORN'LIB</h1>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Accroche -->
                    <h5 class="navbar-nav mr-auto text-justify">
                    Trouvez (ou mettez à disposition) une borne de recharge sur Bordeaux & sa CUB
                    </h5>


                    <!-- ESPACE AUTHENTIFICATION -->
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <!--CONNEXION-->
                            <li>
                                <a type="button" class="nav-link btn btn-success mx-3 text-white" href="{{ route('login') }}">Se connecter</a>
                            </li>
                            <!--INSCRIPTION-->
                        @if (Route::has('register'))
                            <li class="nav-item ">
                               <a type="button" class="nav-link btn btn-success mx-3 text-white" href="{{ route('register') }}">S' inscrire</a>
                            </li>
                        @endif


                        @else
                            <li class="nav-item dropdown">
                                <!--MENU DROPDOWN ET PHOTO DE PROFIL-->
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="/storage/profile_photo/square/{{ Auth::user()->profile_photo}}" alt="profile_photo" id="profile_photo_nav"><span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <!--ACCES A LA PAGE MON COMPTE-->
                                    <a class="dropdown-item" href="{{ route('myaccount') }}">
                                    {{ __('Mon compte') }}
                                    </a>
                                @if(Auth::user()->role == "admin")
                                    <a class="dropdown-item" href="{{ route('Admin') }}">
                                        {{ __('Administration') }}
                                    </a>
                                @endif
                                    <!--DECONNEXION-->
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Se déconnecter') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- MAIN -->
        <main class="py-4">
            @yield('content')
            @include('cookieConsent::index')
        </main>
        <!--FOOTER -->
        <footer class="row bg-white text-center py-3">
            <div class="col-md-12">
               <a href="{{ route('about') }}" style="color: black; text-decoration: underline;">À propos</a> Mentions Légales - <a href="{{ route('contact') }}" id="contact" style="color: black; text-decoration: underline;">Contact</a> - Copyright TEAM XXX
            </div>
        </footer>
@yield('JS')
</body>
</html>
