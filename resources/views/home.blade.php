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


                <form class="col-md-12 d-flex px-0" method="GET">
                    <input type="text" id="recherche" value="" name="test" class="col-md-10 px-0">
                    <input type="button" value="rechercher"  class="col-md-2 px-0">
                    <button type="submit" id="recherche_button">en</button>
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
<?php

if(!empty($_GET) && isset($_GET)){
    $adress=[];

 $address=$_GET["test"];

 $convertedAddress = str_replace(" ", "+", $address);

 $ch = curl_init(); //curl handler init

 curl_setopt($ch,CURLOPT_URL,"https://api-adresse.data.gouv.fr/search/?q=.$convertedAddress.");
 curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);// set optional params
 curl_setopt($ch,CURLOPT_HEADER, false);

 $resultAddress=curl_exec($ch);
 $resultAddress=json_decode($resultAddress);



 $longitude = $resultAddress->features["0"]->geometry->coordinates["0"]; // on récupère latitude et longitude
 $latitude = $resultAddress->features["0"]->geometry->coordinates["1"];
 $newtableaucoordonnes = [];
 $newtableaucoordonnes = [$longitude, $latitude];
}
?>
        </div>
    </div>
</div>


@endsection

@section('JS')

<script>var coordonnes = <?= json_encode($tableau_coordonnes); ?></script>
<?php
if(!empty($_GET) && isset($_GET)){
 echo "<script>var newcoordonnes =". json_encode($newtableaucoordonnes)."</script>" ;}?>

 <?php
if(!empty($_GET) && isset($_GET)){
 echo "<script>var get = true;</script>";}else{echo "<script>var get = false;</script>";}?>

<script src="{{ asset('js/leaflet.js') }}"></script>
<script src="{{ asset('js/leaflet-routing-machine.js') }}"></script>
<script src="{{ asset('js\Control.Geocoder.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/map.js') }}"></script>

@endsection
