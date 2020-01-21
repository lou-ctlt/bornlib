@extends('layouts.app')

@section('content')
    @if(!empty($successMessage))
        <span>{{$successMessage}}</span>
    @endif

<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 text-center">
    <h2 class=""> ADMINISTRATION / TABLEAU DE BORD </h2>
    </div>
    </div>
    
    <div class="row mt-3">
    <div class="col-md-10 offset-md-1">

<div class="card" style="width: 72rem;">
  <div class="card-header">
  <!-- LIEN VERS L'AJOUT D'UTILISATEUR -->
  <a type="button" class="btn btn-primary" href="{{ route('AddUser') }}">Ajouter un utilisateur</a>
  </div>
  <div class="table-striped">
    <table class="card-table table">
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
            <th class="border border-grey" scope="col">VOIR</th>
                    
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
                <a href="{{ route ('ShowUser',['id'=> $user->id]) }}" class="badge badge-primary badge-pill  mx-1">X</a>
            </td>                
                        
        </tr>

          
        @endif
        @endforeach        
       
      </tbody>
      
    </table>
    </div>

    </div>
    
  </div>
</div>
        

        
			
            

      
    
  
        </div>
    </div>
</div>

@endsection