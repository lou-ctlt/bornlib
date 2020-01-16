@extends('layouts.app')
@section('CSS')
    <link rel="stylesheet" href="{{ asset('css/app2.css') }}">
@endsection
@section('content')
<div class="container">
    <!-- Affichage des données personnel si la personne est connecté : START -->

    @if (!empty(session("successMessage")))
        <div class="alert alert-info text-center">
            <span class="help-block">
                <strong>{{ session("successMessage") }}</strong>
            </span>
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center card_head_style">
                    <h4>Bienvenu {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}, voici vos informations !</h4>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-6 mb-2">
                            <h5 class="card-title font-weight-bold">Photo de profil</h5>
                            <img src="storage\profile_photo\{{ Auth::user()->profile_photo }}" alt="Photo de profile de l'utilisateur" id="photo_profil">
                        </div>
                        <div class="col-md-6 mb-2">
                            <h5 class="card-title font-weight-bold">Photo de borne</h5>
                            <img src="storage\electric_terminal_photo\{{ Auth::user()->electric_terminal_photo }}" alt="Photo de la borne de l'utilisateur" id="photo_borne">
                        </div>
                    </div>
                    <p class="card-text"><span class="font-weight-bold">Prénom : </span>{{ Auth::user()->firstname }}</p>
                    <p class="card-text"><span class="font-weight-bold">Nom : </span>{{ Auth::user()->lastname }}</p>
                    <p class="card-text"><span class="font-weight-bold">Email : </span>{{ Auth::user()->email }}</p>
                    <p class="card-text"><span class="font-weight-bold">Adresse : </span>{{ Auth::user()->address }}</p>
                    <p class="card-text"><span class="font-weight-bold">Plaque d'immatriculation : </span>{{ Auth::user()->license_plate }}</p>
                    <p class="card-text"><span class="font-weight-bold">Numéro de votre carte d'Identité : </span>{{ Auth::user()->ID_number }}</p>
                    <p class="card-text"><span class="font-weight-bold">Voiture : </span><?php if( Auth::user()->car == 1) { echo "oui";} else{echo "non";} ?></p>
                    <p class="card-text"><span class="font-weight-bold">Borne éléctrique : </span><?php if( Auth::user()->electric_terminal == 1) { echo "oui";} else{echo "non";} ?></p>
                    <div class="text-right">
                        <button class="btn btn-info" id="form_pop_button">Modifications</button>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    Votre compte date du : {{ Auth::user()->created_at }}
                </div>
            </div>
        </div>
        <div class="col-md-6 img_myaccount_wrapper">
            <img src="storage\img\voiture-electrique-wallbox.png" alt="Photo example d'une borne éléctrique" class="img_myaccount">
        </div>
    </div>
    <!-- Affichage des données personnel si la personne est connecté : END -->

    <!-- Formulaire de modification de données : START -->
    <div class="row mt-3 d-none" id="form_pop">
        <div class="col-md-6 img_myaccount_wrapper">
            <img src="storage\img\borne-de-recharge-evlink.jpg" alt="Photo example d'une borne éléctrique" class="img_myaccount">
        </div>
        <div class="col-md-6">
            <div class="row justify-content-end">
                <div class="card">
                    <div class="card-header text-center card_head_style">
                        <h4>Modifications de vos informations !</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route("userUpdate") }} " method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group card-text">
                                <label for="exampleInputPassword1" class="font-weight-bold">Prénom</label>
                                <input type="text" class="form-control input_style {{ $errors->has("firstname") ? " has-error" : ""}}" id="firstname" name="firstname" value="{{ Auth::user()->firstname }}">
                                @if ($errors->has("firstname"))
                                    <div class="alert alert-danger text-center">
                                        <span class="help-block">
                                            <strong>{{ $errors->first("firstname") }}</strong>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group card-text">
                                <label for="exampleInputPassword1" class="font-weight-bold">Nom</label>
                                <input type="text" class="form-control input_style {{ $errors->has("lastname") ? " has-error" : ""}}" id="lastname" name="lastname" value="{{ Auth::user()->lastname }}">
                                @if ($errors->has("lastname"))
                                    <div class="alert alert-danger text-center">
                                        <span class="help-block">
                                            <strong>{{ $errors->first("lastname") }}</strong>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group card-text">
                                <label for="exampleInputPassword1" class="font-weight-bold">Email</label>
                                <input type="email" class="form-control input_style {{ $errors->has("email") ? " has-error" : ""}}" id="email" name="email" value="{{ Auth::user()->email }}">
                                @if ($errors->has("email"))
                                    <div class="alert alert-danger text-center">
                                        <span class="help-block">
                                            <strong>{{ $errors->first("email") }}</strong>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group card-text">
                                <label for="exampleInputPassword1" class="font-weight-bold">Adresse</label>
                                <input type="text" class="form-control input_style {{ $errors->has("address") ? " has-error" : ""}}" id="address" name="address" value="{{ Auth::user()->address }}">
                                @if ($errors->has("address"))
                                    <div class="alert alert-danger text-center">
                                        <span class="help-block">
                                            <strong>{{ $errors->first("address") }}</strong>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group card-text">
                                <label for="exampleInputPassword1" class="font-weight-bold">Plaque d'immatriculation</label>
                                <input type="text" class="form-control input_style {{ $errors->has("license_plate") ? " has-error" : ""}}" id="license_plate" name="license_plate" value="{{ Auth::user()->license_plate }}">
                                @if ($errors->has("license_plate"))
                                    <div class="alert alert-danger text-center">
                                        <span class="help-block">
                                            <strong>{{ $errors->first("license_plate") }}</strong>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group card-text">
                                <label for="exampleInputPassword1" class="font-weight-bold">Numéro de votre carte d'Identité</label>
                                <input type="text" class="form-control input_style {{ $errors->has("ID_number") ? " has-error" : ""}}" id="ID_number" name="ID_number" value="{{ Auth::user()->ID_number }}">
                                @if ($errors->has("ID_number"))
                                    <div class="alert alert-danger text-center">
                                        <span class="help-block">
                                            <strong>{{ $errors->first("ID_number") }}</strong>
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="row card-text">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="font-weight-bold">Photo de profil</label>
                                        <input type="file" class="form-control-file mb-2 {{ $errors->has("profile_photo") ? " has-error" : ""}}" id="profile_photo" name="profile_photo">
                                        @if ($errors->has("profile_photo"))
                                            <div class="alert alert-danger text-center">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first("profile_photo") }}</strong>
                                                </span>
                                            </div>
                                        @endif
                                        <img src="storage\img\1logoBornLib.jpg" id="img_profile_photo" alt="lien pour uploader l'image votre profile">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1" class="font-weight-bold">Photo de borne</label>
                                        <input type="file" class="form-control-file mb-2 {{ $errors->has("electric_terminal_photo") ? " has-error" : ""}}" id="electric_terminal_photo" name="electric_terminal_photo">
                                        @if ($errors->has("electric_terminal_photo"))
                                            <div class="alert alert-danger text-center">
                                                <span class="help-block">
                                                    <strong>{{ $errors->first("electric_terminal_photo") }}</strong>
                                                </span>
                                            </div>
                                        @endif
                                        <img src="storage\img\istockphotoBornLib.jpg" id="img_electric_terminal_photo" alt="lien pour uploader l'image de votre borne">
                                    </div>
                                </div>
                            </div>
                            <div class="row card-text mb-2">
                                <div class="col-md-6">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" name="car" class="custom-control-input" required value="1">
                                        <label class="custom-control-label font-weight-bold" for="customRadio1">J'ai une voiture</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" name="car" class="custom-control-input" required value="0">
                                        <label class="custom-control-label font-weight-bold" for="customRadio2">J'ai pas de voiture</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio3" name="electric_terminal" class="custom-control-input" required value="1">
                                        <label class="custom-control-label font-weight-bold" for="customRadio3">J'ai une borne éléctrique</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio4" name="electric_terminal" class="custom-control-input" required value="0">
                                        <label class="custom-control-label font-weight-bold" for="customRadio4">J'ai pas de borne éléctrique</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row card-text">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-info">Modifier</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route("password.request") }}" type="button" class="btn btn-info">Changer de MDP ??</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Formulaire de modification de données : END -->

</div>
@endsection
@section('JS')
    <script src="{{ asset('js/app2.js') }}" defer></script>
@endsection
