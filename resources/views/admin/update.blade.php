@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-1 offset-md-10 my-3">
            <a type="button" class="btn btn-secondary" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">RETOUR </a>    
        </div>
    </div>
    
    <div class="row justify-content-center my-3">
        <div class="col-md-6">
            <div class="card my-4">
                <div class="card-header text-center">{{ __('MODIFICATION COMPTE UTILISATEUR') }}</div>
        <!-- START Form -->
                <div class="card-body">

                    
                    <form method="POST" action="{{route('UpdateUser')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row ">
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="lastname" class="col-md-8 col-form-label ">{{ __('Nom') }}</label>
                                <input id="lastname" type="text" class="form-control {{ $errors->has('lastname') ? 'has-error' : ' '}}" name="lastname" value="{{ $errors->has('lastname') ? old(lastname) : $user->lastname }}"  autocomplete="lastname" autofocus>
                         
                                @if ( $errors->has('lastname') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <div class="col-md-6 offset-md-3">
                            <label for="firstname" class="col-md-8 col-form-label">{{ __('Prénom') }}</label>
                                <input id="firstname" type="text" class="form-control {{ $errors->has('firstname') ? 'has-error' : ' '}}" name="firstname" value="{{ $errors->has('firstname') ? old(firstname) : $user->firstname }}"  autocomplete="firstname" autofocus>
                               
                                @if ( $errors->has('firstname') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <label for="email" class="col-md-8 col-form-label">{{ __('Adresse e-mail') }}</label>
                                <input id="email" type="text" class="form-control {{ $errors->has('email') ? 'has-error' : ' '}} " name="email" value="{{ $errors->has('email') ? old('email') : $user->email
                                 }}" >
                               
                                @if ( $errors->has('email') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                     
                        <div class="form-group row">
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="address" class="col-md-8 col-form-label ">{{ __('Adresse postale') }}</label>
                                <input id="address" type="text" class="form-control {{ $errors->has('address') ? 'has-error' : ' '}}" name="address"  autocomplete="new-address" value="{{ $errors->has('address') ? old(address) : $user->address }}" >
                               
                                @if ( $errors->has('firstname') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="ID_number" class="col-md-8 col-form-label ">{{ __('Numéro de CNI') }}</label>
                                <input id="ID_number" type="text" class="form-control {{ $errors->has('ID_number') ? 'has-error' : ' '}}" name="ID_number"  autocomplete="new-ID_number" value="{{ $errors->has('ID_number') ? old('ID_number') : $user->ID_number }}" >
                             
                                @if ( $errors->has('ID_number') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ID_number') }}</strong> 
                                    </span>
                                @endif

                            </div>
                        </div>
                   
                        <div class="form-group row">
                            <div class="form-check col-md-6 offset-md-3">
                                <input class="form-check-input" type="checkbox" id="car" value="{{ $errors->has('car') ? old(car) : $user->car }}" name="car" >
                                <label class="form-check-label" for="car">J'ai une voiture, je cherche une borne.</label>
                            </div>
                        </div>
                        <div class="form-group row" id="license_plate">
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="license_plate" class="col-md-8 col-form-label">{{ __('Numéro d\'immatriculation') }}</label>
                                <input type="text" class="form-control {{ $errors->has('license_plate') ? 'has-error' : ' '}}" name="license_plate" value="{{ $errors->has('license_plate') ? old(license_plate) : $user->license_plate }} ">
                          
                                @if ( $errors->has('license_plate') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('license_plate') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-check col-md-6 offset-md-3">
                                <input class="form-check-input " type="checkbox" id="terminal" value="{{ $errors->has('electric_terminal') ? old(electric_terminal) : $user->electric_terminal }}" name="electric_terminal">
                                <label class="form-check-label" for="terminal">Je propose l'accès à ma borne.</label>
                            </div>
                        </div>

                        <div class="form-group row" id="electric_terminal_photo">
                            
                            <div class="col-md-6 offset-md-3">
                                
                                <label for="electric_terminal_photo" class="col-md-8 col-form-label">{{ __('Changer la photo de la borne') }}</label>
                                <input type="file" class="form-control-file {{ $errors->has('electric_terminal_photo') ? 'has-error' : ' '}}" name="electric_terminal_photo" value="{{ $errors->has('electric_terminal_photo') ? old(electric_terminal_photo) : $user->electric_terminal }}">
                             
                                @if ( $errors->has('license-plate') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('electric_terminal_photo') }}</strong> 
                                    </span>
                                @endif
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <div class="col-md-6 offset-md-3">
                                 
                                <label for="profile_photo" class="col-md-8 col-form-label">{{ __('Changer la photo du profil') }}</label>
                                <input id="profile_photo" type="file" class="form-control-file @error('profile_photo') is-invalid @enderror" name="profile_photo" value="{{ $errors->has('profile_photo') ? old(profile_photo) : $user->profile }}" >
                            
                                
                                
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-5 ">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Enregistrer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
        <!-- END Form -->
    </div>
</div>
@endsection('content')
@section('JS')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{asset('js/admin.js')}}"> </script> 
<script src="{{asset('js/form.js')}}"> </script> 
@endsection
