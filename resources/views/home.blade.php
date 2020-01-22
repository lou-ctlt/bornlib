@extends('layouts.app')
@section('CSS')
<link rel="stylesheet" href=" {{ asset('css/leaflet.css') }}" />
<link rel="stylesheet" href=" {{ asset('css/leaflet-routing-machine.css') }}" />
<link rel="stylesheet" href=" {{ asset('css/map.css') }}" />

@endsection
@section('content')
<div class="container">
    <div class="row">
        <span class="help-block text-center mb-2">
            <h2>Utilisation de la carte.</h2>
            <p class="text-justify">La carte Bornlib vous affiche toutes les bornes avec des marqueurs en forme de branche. Les marqueurs verts représentent les bornes libres et les rouges les bornes utilisées. En cliquant sur un marqueur vert nous vous proposons de réserver une borne durant 2h, cela représente le temps que vous avez pour vous rendre sur place et recharger votre voiture. Une fois le click sur le bouton réservé effectué la carte se rechargera et la borne que vous avez réservée sera donc rouge, <span class="font-weight-bold">vous recevrez un email</span> qui comprendra une photo de la borne ainsi qu'un lien vers google maps qui comprendra l'itinéraire vers celle-ci.</p>
        </span>
    </div>
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
                    $tableau_updated_at =[];
                    $n=1;
                    foreach ($users as $user) {
                        $v1 = $user->longitude;
                        $v2 = $user->latitude;
                        if($user->latitude != "NULL"){
                            $tableau_coordonnes += [$v1 => $v2];
                        }
                        $tableau_updated_at += [$n => $user->updated_at]; // Je stocke les updated_at dans un tableau pour rafraichir les réservations
                        $n++;
                    }
            ?>
        </div>
    </div>
</div>


@endsection

@section('JS')

<script>var updated_at = <?= json_encode($tableau_updated_at); ?></script>
<script>var coordonnes = <?= json_encode($tableau_coordonnes); ?></script>
<script src="{{ asset('js/leaflet.js') }}"></script>
<script src="{{ asset('js/leaflet-routing-machine.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/map.js') }}"></script>

@endsection
