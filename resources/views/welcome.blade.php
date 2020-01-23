@extends('layouts.app')

    @section('content')


        <div class="container">
            <!--CAROUSEL -->
            <div class="row">
                <div id="carouselExampleControls" class="carousel slide mb-3" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="/storage/img/carsharing.jpg" alt="First slide">
                            <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.3);">
                                <h5>BORN'LIB</h5>
                                <p>est la solution la plus pertinente pour trouver les bornes de recharge disponibles à utiliser sur Bordeaux et sa CUB.<br>
                                    Notre communauté de particuliers mettant leur borne à disposition permet de constituer un parc très complet et très fiable.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="/storage/img/carsharing-hands.jpg" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.3);">
                                <h5>Roulez serein !</h5>
                                <p>Simplifiez la recharge de votre véhicule électrique avec BORN' LIB.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="/storage/img/carte-carousel.jpg" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.3);">
                                <h5>Déja plus de 50 bornes en partage par des particuliers autour de vous !</h5>
                                <p>Trouvez une borne de recharge disponible sur Bordeaux & sa CUB</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="/storage/img/electric.jpg" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block" style="background-color: rgba(0, 0, 0, 0.3);">
                                <h5>N'attendez plus, inscrivez-vous !</h5>
                                @if (Route::has('register'))
                                   <h6><a type="button" class="nav-link btn mx-3 text-white font-weight-bold" href="{{ route('register') }}">S' inscrire</a></h6>
                                @endif
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    @endsection















