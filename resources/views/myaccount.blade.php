@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Affichage des données personnel si la personne est connecté : START -->
    @if (Auth::check())
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4>Bienvenu {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}, vous êtes correctement connecté !</h4>
            </div>
            <div class="card-body">
            <h5 class="card-title">Vos informations :</h5>
            <p class="card-text">Prénom : {{ Auth::user()->firstname }}</p>
            <p class="card-text">Nom : {{ Auth::user()->lastname }}</p>
            <p class="card-text">Email : {{ Auth::user()->email }}</p>
            <p class="card-text">Adresse : {{ Auth::user()->address }}</p>
            <p class="card-text">Plaque d'immatriculation : {{ Auth::user()->license_plate }}</p>
            <p class="card-text">CNI : {{ Auth::user()->ID_number }}</p>
            <p class="card-text">Voiture : {{ $meta_user[0]->car }}</p>
            <p class="card-text">Borne éléctrique : {{ $meta_user[0]->electric_terminal }}</p>
            <p class="card-text">Photo de profile : {{ $meta_user[0]->profile_photo }}</p>
            <p class="card-text">Photo de borne : {{ $meta_user[0]->electric_terminal_photo }}</p>
            <a href="#" class="btn btn-primary" id="form_pop_button">Modifications</a>
            </div>
            <div class="card-footer text-muted">
            Votre compte date du : {{ Auth::user()->created_at }}
            </div>
        </div>
    </div>
    <!-- Affichage des données personnel si la personne est connecté : END -->

    <!-- Formulaire de modification de données : START -->
    <form class="d-none" action="{{ route("userUpdate") }} " method="post" enctype="multipart/form-data" id="form_pop">
        @csrf
        <div class="form-group">
            <label for="exampleInputPassword1">Prénom</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ Auth::user()->firstname }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Nom</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ Auth::user()->lastname }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Plaque d'immatriculation</label>
            <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{ Auth::user()->license_plate }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">CNI</label>
            <input type="text" class="form-control" id="ID_number" name="ID_number" value="{{ Auth::user()->ID_number }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Voiture</label>
            <input type="text" class="form-control" id="car" name="car" value="{{ $meta_user[0]->car }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Borne éléctrique</label>
            <input type="text" class="form-control" id="electric_terminal" name="electric_terminal" value="{{ $meta_user[0]->electric_terminal }}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Photo de profile</label>
            <input type="file" class="form-control-file" id="profile_photo" name="profile_photo">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Photo de borne</label>
            <input type="file" class="form-control-file" id="electric_terminal_photo" name="electric_terminal_photo">
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    <a href="{{ route("password.request") }}" type="button" class="btn btn-primary">Changer de MDP ??</a>
    </form>
    <!-- Formulaire de modification de données : END -->
    @endif
</div>
@endsection
