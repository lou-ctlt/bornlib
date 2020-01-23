@extends('layouts.app')

    @section('content')
    <!-- AFFICHAGE FICHE UTILISATEUR -->
    <div class="container-fluid">
    <!--START ROW BOUTON RETOUR  -->
    <div class="row">
      <div class="col-md-1 offset-md-10 my-3">
        <a type="button" class="btn btn-secondary" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">RETOUR </a>   
      </div>
    </div>
    <!--END ROW BOUTON RETOUR  -->
    <!--START ROW FICHE UTILISATEUR  -->
    <div class="row my-3">

    <div class="col-md-3">
    <img src="/storage/electric_terminal_photo/{{$user->electric_terminal_photo}}" alt="Photo de la borne de l'utilisateur" style="width: 15rem; margin-right: 10px;">
    <img src="/storage/profile_photo/{{ $user->profile_photo }}" alt="Photo de l'utilisateur" style="width: 15rem;">
    </div>
    
    <div class="col-md-6">
      <div class="card w-100" style="">
  
        <div class="card-header text-center font-weight-bold">{{ __('FICHE UTILISATEUR') }}</div>

        <div class="card-body">
          <h5 class="card-title">{{$user->firstname}} {{$user->lastname}}</h5>
        <div class="row">

          <div class="col-md-4">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">N° d'utilisateur -></li>
              <li class="list-group-item">Date d'inscription-></li>
              <li class="list-group-item">Adresse email -></li>
              <li class="list-group-item">Adresse postale -></li>
              <li class="list-group-item">N° de CNI -></li>
              <li class="list-group-item">Propriétaire voiture -></li>
              <li class="list-group-item">N° d'immatriculation -></li>
              <li class="list-group-item">Propriétaire borne -></li>
              <li class="list-group-item">Dernière modification -></li>
            </ul>
          </div>
          
          <div class="col-md-8">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">{{$user->id}}</li>
              <li class="list-group-item">{{$user->created_at->format('d M Y')}}</li>
              <li class="list-group-item"><a href="mailto:{{$user->email}}">{{$user->email}}</a></li>
              <li class="list-group-item">{{$user->address}}</li>
              <li class="list-group-item">{{$user->ID_number}}</li>
              <li class="list-group-item">{{$user->car}}</li>
              <li class="list-group-item">{{$user->license_plate}}</li>
              <li class="list-group-item">{{$user->electric_terminal}}</li>
              <li class="list-group-item">{{$user->updated_at->format('d M Y - H:i:s')}}</li>
            </ul>
          </div>
  
        </div>

        <div class="card-footer bg-transparent border-success text-right">
        <!-- LIEN VERS LA METHODE UPDATE -->
          <a href="{{ route ('EditUser',['id'=> $user->id])}}" class="btn btn-success my-1">Modifier l'utilisateur</a>
        <!-- LIEN VERS LA METHODE DELETE -->
          <a href="{{ route ('DeleteUser',['id'=> $user->id])}}" class="btn btn-danger my-1">Supprimer l'utilisateur</a>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
  
@endsection('content')
@section('JS')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>

@endsection