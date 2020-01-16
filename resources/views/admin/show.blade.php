@extends('layouts.app')

    @section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 offset-md-2 text-center">
        <h1>FICHE DE L UTILISATEUR</h1>
			<table class="table">
   <thead>
    <tr class="text-center">
      <th class="border border-grey" scope="col">ID</th>
      <th class="border border-grey" scope="col">Nom</th>
      <th class="border border-grey" scope="col">Prénom</th>
      <th class="border border-grey" scope="col">Email</th>
      <th class="border border-grey" scope="col">Adresse</th>
      
      
    </tr>
   </thead>
    <tbody>
  
    <tr class="text-center">
      
      <td class="border border-grey">{{$user->id}}</td>
      <td class="border border-grey">{{$user->firstname}}</td>
      <td class="border border-grey">{{$user->lastname}}</td>
      <td class="border border-grey">{{$user->email}}</td>
      <td class="border border-grey">{{$user->address}}</td>
     
    </tr>
    
  </tbody>
</table>
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <img src="storage\electric_terminal_photo\{{$user->electric_terminal_photo}}" alt="Photo de la borne de l'utilisateur">
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 offset-md-2">
    <img src="storage\profile_photo\{{$user->profile_photo}}" alt="Photo de la photo de l'utilisateur">
    </div>
  </div>



		</div>
	</div>
</div>
@endsection('content')