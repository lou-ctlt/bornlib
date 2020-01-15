<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href=" {{ asset('css/app.css') }}" />
        <link rel="stylesheet" href=" {{ asset('css/leaflet.css') }}" />

        <link rel="stylesheet" href=" {{ asset('css/leaflet-routing-machine.css') }}" />



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
            #mapid {
                height: 700px;
            width: 700px;
         }
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
            <form>
            <input type="text" id="recherche" value="" name="test">
            <input type="button" value="rechercher" id="recherche_button">
        </form>
            <div id="mapid"></div>

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <?php
                $tableau_coordonnes =[];

                ?>
                @foreach($users as $user)
                    <td>{{ $user->longitude }}</td>
                    <td>{{ $user->latitude }}</td>
                    <?php
                    $v1 = $user->longitude;
                    $v2 = $user->latitude;
                    $tableau_coordonnes += [$v1 => $v2];

                    ?>
                @endforeach

                </div>


                <script>
                    var coordonnes = <?php echo json_encode($tableau_coordonnes); ?>;
                </script>
                <script src="{{ asset('js/leaflet.js') }}"></script>
                <script src="{{ asset('js/leaflet-routing-machine.js') }}"></script>
                <script src="{{ asset('js\Control.Geocoder.js') }}"></script>
                <script src="{{ asset('js/app.js') }}"></script>
                <script src="{{ asset('js/map.js') }}"></script>
            </div>
        </div>
    </body>
</html>
