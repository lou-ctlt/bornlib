@extends('layouts.app')

    @section('content')
    <div class="container-fluid">
    <div class="row">
    <div class="col-md-3">
    <img src="/storage/electric_terminal_photo/{{$user->electric_terminal_photo}}" alt="Photo de la borne de l'utilisateur" style="width: 15rem; margin-right: 10px;">
    <img src="/storage/profile_photo/{{$user->profile_photo}}" alt="Photo de la photo de l'utilisateur" style="width: 15rem;">

    </div>
    <div class="col-md-6">
<div class="card w-100" style="">

  <div class="card-header text-center">{{ __('FICHE UTILISATEUR') }}</div>
  <div class="card-body">
    <h5 class="card-title">{{$user->firstname}} {{$user->lastname}}</h5>
    <div class="row">
    <div class="col-md-4">
    <ul class="list-group list-group-flush">
    <li class="list-group-item">N° d'utilisateur -></li>
    <li class="list-group-item">Adresse email -></li>
    <li class="list-group-item">Adresse postale -></li>
    <li class="list-group-item">N° de CNI-></li>
    <li class="list-group-item">N° d'immatriculation-></li>

  </ul>
  </div>
  <div class="col-md-8">
    <ul class="list-group list-group-flush">
    <li class="list-group-item">{{$user->id}}</li>
    <li class="list-group-item">{{$user->email}}</li>
    <li class="list-group-item">{{$user->address}}</li>
    <li class="list-group-item">{{$user->ID_number}}</li>
    <li class="list-group-item">{{$user->license_plate}}</li>

  </ul>
  </div>
  </div>
    <div class="card-footer bg-transparent border-success">
      <a href="{{ route ('EditUser',['id'=> $user->id])}}" class="btn btn-success">Modifier l'utilisateur</a>
      <a href="{{ route ('DeleteUser',['id'=> $user->id])}}" class="btn btn-danger">Supprimer l'utilisateur</a>
      <a href="" class="btn btn-primary">Envoyer un mail à l'utilisateurr</a>
  </tbody>
</table>
  <div class="row">


  </div>
</div>

</div>
</div>
</div>
	</div>
</div>
@endsection('content')
