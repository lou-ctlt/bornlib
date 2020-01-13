<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href=" {{ asset('css/leaflet.css') }}" />
        <link rel="stylesheet" href=" {{ asset('css/TravelNotes.min.css') }}" />
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .map {
            position: absolute;
            width: 50%;
            height: 50%;
        }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>


                <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
                integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
                crossorigin=""></script>
    <script src="{{ asset('js/leaflet.js') }}"></script>
    <script src="{{ asset('js/app2.js') }}"></script>
    <script src="{{ asset('js/TravelNotes.min.js') }}"></script>
    <script src="{{ asset('js/TravelNotesProviders/MapboxRouteProvider.min.js') }}"></script>
    <script src="{{ asset('js/TravelNotesProviders/GraphHopperRouteProvider.min.js') }}"></script>
    <script src="{{ asset('js/TravelNotesProviders/OpenRouteServiceRouteProvider.min.js') }}"></script>
    <script src="{{ asset('js/TravelNotesProviders/OSRMRouteProvider.min.js') }}"></script>
    <script src="{{ asset('js/TravelNotesProviders/PublicTransportRouteProvider.min.js') }}"></script>
    <script src="{{ asset('js/TravelNotesProviders/PolylineRouteProvider.min.js') }}"></script>
            </div>
        </div>
    </body>
</html>
