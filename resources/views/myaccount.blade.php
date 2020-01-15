@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Affichage des données personnel si la personne est connecté : START -->
    @if (Auth::check())
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4>Bienvenu {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}, voici vos informations !</h4>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-6">
                        <h5 class="card-title">Photo de profil</h5>
                    </div>
                    <div class="col-md-6">
                        <h5 class="card-title">Photo de borne</h5>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-md-6">
                        <img src="storage\electric_terminal_photo\{{ Auth::user()->profile_photo }}" alt="Photo de profile de l'utilisateur" id="photo_profil">
                    </div>
                    <div class="col-md-6">
                        <img src="storage\electric_terminal_photo\{{ Auth::user()->electric_terminal_photo }}" alt="Photo de la borne de l'utilisateur" id="photo_borne">
                    </div>
                </div>
                <p class="card-text">Prénom : {{ Auth::user()->firstname }}</p>
                <p class="card-text">Nom : {{ Auth::user()->lastname }}</p>
                <p class="card-text">Email : {{ Auth::user()->email }}</p>
                <p class="card-text">Adresse : {{ Auth::user()->address }}</p>
                <p class="card-text">Plaque d'immatriculation : {{ Auth::user()->license_plate }}</p>
                <p class="card-text">Numéro de votre carte d'Identité : {{ Auth::user()->ID_number }}</p>
                <p class="card-text">Voiture : <?php if( Auth::user()->car == 1) { echo "oui";} else{echo "non";} ?></p>
                <p class="card-text">Borne éléctrique : <?php if( Auth::user()->electric_terminal == 1) { echo "oui";} else{echo "non";} ?></p>
                <p class="card-text">Photo de profile : {{ Auth::user()->profile_photo }}</p>
                <p class="card-text">Photo de borne : {{ Auth::user()->electric_terminal_photo }}</p>
                <div class="text-right">
                    <button class="btn btn-primary" id="form_pop_button">Modifications</button>
                </div>
            </div>
            <div class="card-footer text-muted">
                Votre compte date du : {{ Auth::user()->created_at }}
            </div>
        </div>
    </div>
    <!-- Affichage des données personnel si la personne est connecté : END -->

    <!-- Formulaire de modification de données : START -->
    <div class="d-none row justify-content-end" id="form_pop">
        <div class="card">
            <div class="card-header">
                <h4>Modifications de vos informations !</h4>
            </div>
            <div class="card-body">
                <form action="{{ route("userUpdate") }} " method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group card-text">
                        <label for="exampleInputPassword1">Prénom</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required value="{{ Auth::user()->firstname }}">
                    </div>
                    <div class="form-group card-text">
                        <label for="exampleInputPassword1">Nom</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required value="{{ Auth::user()->lastname }}">
                    </div>
                    <div class="form-group card-text">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required value="{{ Auth::user()->email }}">
                    </div>
                    <div class="form-group card-text">
                        <label for="exampleInputPassword1">Adresse</label>
                        <input type="text" class="form-control" id="address" name="address" required value="{{ Auth::user()->address }}">
                    </div>
                    <div class="form-group card-text">
                        <label for="exampleInputPassword1">Plaque d'immatriculation</label>
                        <input type="text" class="form-control" id="license_plate" name="license_plate" required value="{{ Auth::user()->license_plate }}">
                    </div>
                    <div class="form-group card-text">
                        <label for="exampleInputPassword1">Numéro de votre carte d'Identité</label>
                        <input type="text" class="form-control" id="ID_number" name="ID_number" required value="{{ Auth::user()->ID_number }}">
                    </div>
                    <div class="row card-text">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Photo de profil</label>
                                <input type="file" class="form-control-file" id="profile_photo" name="profile_photo">
                                <img id="img_profile_photo" alt="lien pour uploader l'image votre profile">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Photo de borne</label>
                                <input type="file" class="form-control-file" id="electric_terminal_photo" name="electric_terminal_photo">
                                <img id="img_electric_terminal_photo" alt="lien pour uploader l'image de votre borne">
                            </div>
                        </div>
                    </div>
                    <div class="row card-text mb-2">
                        <div class="col-md-6">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio1" name="car" class="custom-control-input" required value="1">
                                <label class="custom-control-label" for="customRadio1">J'ai une voiture</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio2" name="car" class="custom-control-input" required value="0">
                                <label class="custom-control-label" for="customRadio2">J'ai pas de voiture</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="electric_terminal" class="custom-control-input" required value="1">
                                <label class="custom-control-label" for="customRadio3">J'ai une borne éléctrique</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio4" name="electric_terminal" class="custom-control-input" required value="0">
                                <label class="custom-control-label" for="customRadio4">J'ai pas de borne éléctrique</label>
                            </div>
                        </div>
                    </div>
                    <div class="row card-text">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{ route("password.request") }}" type="button" class="btn btn-primary">Changer de MDP ??</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Formulaire de modification de données : END -->
    @endif
</div>
@endsection
