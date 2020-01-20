@extends('layouts.app')
@section('CSS')
<link rel="stylesheet" href=" {{ asset('css/leaflet.css') }}" />
<link rel="stylesheet" href=" {{ asset('css/leaflet-routing-machine.css') }}" />
<link rel="stylesheet" href=" {{ asset('css/map.css') }}" />

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">


<div class="col-md-12 px-0 d-flex justify-content-around">
                    <label for="" class="col-md-2 px-0">Recherche de borne vers :</label>
                    <input type="text" id="recherche" value="" name="test" class="col-md-7 px-0 ">
                    <input type="button" value="chercher"  class="col-md-1 " id="recherche_button">
                    <input type="button" id="localisation" value="recentrer" class="col-md-1 ">
</div>

                    <div id="mapid" class="col-md-12 mt-3"></div>

                    <?php
                     $tableau_coordonnes =[];
                    foreach ($users as $user) {
                    $latitude = $user->latitude;
                    $longitude = $user->longitude;
                    $tableau_coordonnes += [$latitude => $longitude];
                 }

                    ?>

        </div>
    </div>
</div>


@endsection

@section('JS')

<script>var coordonnes = <?= json_encode($tableau_coordonnes); ?></script>

<script src="{{ asset('js/leaflet.js') }}"></script>
<script src="{{ asset('js/leaflet-routing-machine.js') }}"></script>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/map.js') }}"></script>

@endsection
