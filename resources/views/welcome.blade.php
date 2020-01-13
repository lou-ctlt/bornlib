@extends('layouts.app')

    @section('content')
        
           
        <div class="container-fluid">
           
            <div class="row">
                <div class="col-md-6">
                    <img class="w-100"src="{{asset('storage/img/logo-voiture-electrique.jpg')}}" alt="voiture">
                    <h3 class="text-center">Vous cherchez une borne pour recharger votre voiture?<br>
                    Vous souhaitez mettre votre borne de rechargement à disposition?<br>
                    BORN' LIB est fait pour vous!
                    </h3>
                </div>
                <div class="col-md-6">
                    <h1 class="text-center">
                    Plus de batterie?! <br>
                    Inscrivez- vous sur  BORN'LIB!
                    
                    </h1>
                    <img class="w-75 ml-4 "src="{{asset('storage/img/images.jfif')}}" alt="carte">
                    
                </div>
            </div>
        </div>
    @endsection
        
            


