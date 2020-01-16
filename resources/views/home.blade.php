@extends('layouts.app')
@section('CSS')
<link rel="stylesheet" href=" {{ asset('css/leaflet.css') }}" />
<link rel="stylesheet" href=" {{ asset('css/leaflet-routing-machine.css') }}" />
<link rel="stylesheet" href=" {{ asset('css/map.css') }}" />
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">


                <form class="col-md-12 d-flex px-0">
                    <input type="text" id="recherche" value="" name="test" class="col-md-10 px-0">
                    <input type="button" value="rechercher" id="recherche_button" class="col-md-2 px-0">
                </form>
                    <div id="mapid" class="col-md-12 mt-3"></div>

                    <?php
                     $tableau_coordonnes =[];
                    foreach ($users as $user) {
                    $v1 = $user->longitude;
                    $v2 = $user->latitude;
                    $tableau_coordonnes += [$v1 => $v2];
                 }
                    ?>

        </div>
    </div>
</div>
@endsection

@section('JS')
<script>var coordonnes = <?php echo json_encode($tableau_coordonnes); ?></script>
<script src="{{ asset('js/leaflet.js') }}"></script>
<script src="{{ asset('js/leaflet-routing-machine.js') }}"></script>
<script src="{{ asset('js\Control.Geocoder.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/map.js') }}"></script>
@endsection
