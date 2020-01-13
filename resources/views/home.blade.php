@extends('layouts.app')

@section('content')
<div class="container">
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div> --}}

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
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
                <div class="card-footer text-muted">
                  Votre compte date du : {{ Auth::user()->created_at }}
                </div>
              </div>
        </div>

        {{-- {{ dd(Auth::user()) }} --}}
    @endif
    <!-- Affichage des données personnel si la personne est connecté : START -->
</div>
@endsection
