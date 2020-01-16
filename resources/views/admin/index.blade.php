@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
        <h2 class="text-center">ADMINISTRATION</h2>

        
			<table class="table table-striped">
                <thead>
                    <tr class='text-center'>
                        <th  class="border border-grey" scope="col">#</th>
                        <th  class="border border-grey"scope="col">Nom</th>
                        <th  class="border border-grey"scope="col">Prénom</th>
                        <th  class="border border-grey"scope="col">Email</th>
                        <th  class="border border-grey"scope="col">Adresse</th>
                        <th  class="border border-grey"scope="col">Immat</th>
                        <th  class="border border-grey"scope="col">CNI</th>
                        <th class="border border-grey" scope="col">Voir/Modifier/Supprimer</th>
                    </tr>
                </thead>
                <tbody>
  	            @foreach($users as $user)
                    <tr class='text-center'>
      
                        <td class="border border-grey">{{$user->id}}</td>
                        <td class="border border-grey">{{$user->firstname}}</td>
                        <td class="border border-grey">{{$user->lastname}}</td>
                        <td class="border border-grey">{{$user->email}}</td>
                        <td class="border border-grey">{{$user->address}}</td>
                        <td class="border border-grey">{{$user->license_plate}}</td>
                        <td class="border border-grey">{{$user->ID_number}}</td>
                        <td class="border border-grey">
                            <a href="{{ route ('ShowUser',['id'=> $user->id]) }}" class="badge badge-primary badge-pill  mx-1">X</a>
                            <a href="{{ route ('EditUser',['id'=> $user->id])}}" class="badge badge-success badge-pill  mx-1">X</a>
                            <a href="{{ route ('DeleteUser',['id'=> $user->id]) }}" class="badge badge-danger badge-pill  mx-1"> X </a>
                        </td>
                    </tr>
                @endforeach
    
                </tbody>
            </table>
            <button><a  href="">Ajouter un utilisateur</a></button>

      
    
  
        </div>
    </div>
</div>

@endsection