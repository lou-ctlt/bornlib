@extends('layouts.app')

@section('content')
<div class="container">

  @if(!empty($successMessage))
    <span>{{$successMessage}}</span>
  @endif

  <div class="row my-3">
    <div class="col-md-12 text-center">
      <h2 class="font-weight-bold bg-success text-white py-3"> ESPACE ADMINISTRATION </h2>
    </div>
  </div>
 
<br>
<br>
<h5><u>LISTE DES ADMINISTRATEURS</u></h5>
<!-- START TABLE ADMIN -->
  <div class="row my-3">
    <div class="table-responsive-sm table-striped">
      <table class="table">
          <thead>
            <tr class='text-center'>
              <th  class="border border-grey"scope="col">Nom</th>
              <th  class="border border-grey"scope="col">Prénom</th>
              <th  class="border border-grey"scope="col">Email</th>
              <th  class="border border-grey"scope="col">Adresse</th>
              <th class="border border-grey" scope="col">FICHE</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            @if($user->role != 'user')
            <tr class='text-center'>
              <td class="border border-grey">{{$user->firstname}}</td>
              <td class="border border-grey">{{$user->lastname}}</td>
              <td class="border border-grey"><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
              <td class="border border-grey">{{$user->address}}</td>
              <td class="border border-grey">
                <a href="{{ route ('ShowUser',['id'=> $user->id]) }}" class="badge badge-primary badge-pill mx-1" style="font-size: 1rem;">&#x1F58A;</a>
              </td>
            </tr>
            @endif
            @endforeach
          </tbody>
      </table>
    </div>
  </div>
<!-- END TABLE ADMIN -->
<br>
  <div class="row">
    <div class="col-md-2 offset-md-10 my-3">
      <a type="button" class="btn btn-success px-1" href="{{ route('AddUser') }}">Ajouter un utilisateur</a>
    </div>
  </div>
<br>

    <h5><u>LISTE DES UTILISATEURS</u></h5>
    <!-- START TABLE USER -->
    <div class="row my-3">
        <!-- <div class="col-12"> -->
        <div class="table-responsive-sm table-striped">
            <table class="table">
                <thead>
                    <tr class='text-center'>
                        <th  class="border border-grey" scope="col">#</th>
                        <th  class="border border-grey"scope="col">Nom</th>
                        <th  class="border border-grey"scope="col">Prénom</th>
                        <th  class="border border-grey"scope="col">Email</th>
                        <th  class="border border-grey"scope="col">Adresse</th>
                        <th  class="border border-grey"scope="col">Immat</th>
                        <th  class="border border-grey"scope="col">CNI</th>
                        <th  class="border border-grey"scope="col">CAR</th>
                        <th  class="border border-grey"scope="col">BORNE</th>
                        <th class="border border-grey" scope="col">FICHE</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    @if($user->role != 'admin')
                        <tr class='text-center'>
                            <td class="border border-grey">{{$user->id}}</td>
                            <td class="border border-grey">{{$user->firstname}}</td>
                            <td class="border border-grey">{{$user->lastname}}</td>
                            <td class="border border-grey">{{$user->email}}</td>
                            <td class="border border-grey">{{$user->address}}</td>
                            <td class="border border-grey">{{$user->license_plate}}</td>
                            <td class="border border-grey">{{$user->ID_number}}</td>
                            <td class="border border-grey">{{$user->car}}</td>
                            <td class="border border-grey">{{$user->electric_terminal}}</td>
                            <td class="border border-grey">
                                <a href="{{ route ('ShowUser',['id'=> $user->id]) }}" class="badge badge-primary badge-pill mx-1" style="font-size: 1rem;">&#x1F58A;</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- END TABLE USER -->

<?php

$car = 0;
$borne = 0;
$corne = 0;
$i=0;

foreach($users as $user){
    if($user->role == 'user'){
        $car += $user->car;
        $borne += $user->electric_terminal;
        $i++;
        if($user->car == 1 && $user->electric_terminal == 1){
            $corne++;
        }else{
            $corne += 0;
        }
    }
}

$nb_car= ($car/$i)*100 . " %";

$nb_borne= ($borne/$i)*100 . " %";

$nb_corne= ($corne/$i)*100 . " %";

echo    '<div class="container">
            <h5><u>TABLEAU DES STATISTIQUES</u></h5>
            <div class="row my-3">
                <div class="table-responsive-sm table-striped">
                    <table>
                        <thead>
                            <tr>
                                <th class="border border-grey p-2 text-justify-content">Nbre d\'utilisateurs</th>
                                <th class="border border-grey p-2 text-justify-content">%  ayant une voiture</th>
                                <th class="border border-grey p-2 text-justify-content">% ayant une borne</th>
                                <th class="border border-grey p-2 text-justify-content">%  ayant voiture et borne</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td class="border border-grey p-2 text-center">'.$nb_user = $i.'</td>
                                <td class="border border-grey p-2 text-center">'.$nb_car.'</td>
                                <td class="border border-grey p-2 text-center">'.$nb_borne.'</td>
                                <td class="border border-grey p-2 text-center">'.$nb_corne.'</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>'
?>

@endsection

@section('JS')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{asset('js/admin.js')}}"> </script>
<script src="{{asset('js/form.js')}}"> </script>
@endsection
