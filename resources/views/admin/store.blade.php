@extends('layouts.app')



@section('content')

<div class="container-fluid bg-light">
    <div class="row my-3">
        <div class="col-md-1 offset-md-11">
            <a type="button" class="btn btn-secondary" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">RETOUR</a>    
        </div>
    </div>
    <div class="row justify-content-center my-3">
        <div class="col-md-6">
            <div class="card my-4">
                <div class="card-header text-center">{{ __('AJOUTER UN UTILISATEUR') }}</div>
        
                <div class="card-body">

                    <!-- START FORMULAIRE -->
                    <form method="POST" action="{{route('StoreUser')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row ">

                        
                            <div class="col-md-6 offset-md-3">
                                <label for="inputState">Rôle</label>
                                <select id="inputState" class="form-control" name="role">
                                
                                    <option value='admin' >Administrateur</option>
                                    <option value='user'>Utilisateur</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="lastname" class="col-md-8 col-form-label ">{{ __('Nom') }}</label>
                                <input id="lastname" type="text" class="form-control {{ $errors->has('lastname') ? 'has-error' : ' '}}" name="lastname" value="{{ old('lastname') }}"  autocomplete="lastname" autofocus>
                         
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
                                <input id="firstname" type="text" class="form-control {{ $errors->has('firstname') ? 'has-error' : ' '}}" name="firstname" value="{{ old('firstname') }}"  autocomplete="firstname" autofocus>
                               
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
                                <input id="email" type="text" class="form-control {{ $errors->has('email') ? 'has-error' : ' '}} " name="email" value="{{ old('email') }}">
                               
                                @if ( $errors->has('email') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                        <div class="col-md-6 offset-md-3">
                            <label for="password" class="col-md-8 col-form-label ">{{ __('Mot de passe') }}</label>
                                <input id="password" type="password" class="form-control" name="password" value="00000000">
                            
                                <!--@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror-->
                            </div>
                        </div>
                     
                        <div class="form-group row">
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="address" class="col-md-8 col-form-label ">{{ __('Adresse postale') }}</label>
                                <input id="address" type="text" class="form-control {{ $errors->has('address') ? 'has-error' : ' '}}" placeholder="1 rue de l'adresse Ville 00000" name="address"  autocomplete="new-address" value="{{ old('address') }}">
                               
                                @if ( $errors->has('address') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="ID_number" class="col-md-8 col-form-label ">{{ __('Numéro de CNI') }}</label>
                                <input id="ID_number" type="text" class="form-control {{ $errors->has('ID_number') ? 'has-error' : ' '}}" name="ID_number"  autocomplete="new-ID_number" value="{{ old('ID_number') }}" >
                             
                                @if ( $errors->has('ID_number') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ID_number') }}</strong> 
                                    </span>
                                @endif

                            </div>
                        </div>
                   
                        <div class="form-group row">
                            <div class="form-check col-md-6 offset-md-3">
                                <input class="form-check-input" type="checkbox" id="car" value="1" name="car">
                                <label class="form-check-label" for="car">J'ai une voiture, je cherche une borne.</label>
                            </div>
                        </div>
                        <div class="form-group row" id="license-plate">
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="license_plate" class="col-md-8 col-form-label">{{ __('Numéro d\'immatriculation') }}</label>
                                <input type="text" class="form-control {{ $errors->has('license_plate') ? 'has-error' : ' '}}" placeholder="XX-000-XX" name="license_plate">
                          
                                @if ( $errors->has('license-plate') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('license-plate') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-check col-md-6 offset-md-3">
                                <input class="form-check-input " type="checkbox" id="terminal" value="1" name="electric_terminal">
                                <label class="form-check-label" for="terminal">Je propose l'accès à ma borne.</label>
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            

                            <div class="col-md-6 offset-md-3">
                            <label for="electric_terminal_photo" class="col-md-8 col-form-label ">{{ __('Choisir une photo de ma borne') }}</label>
                                <input type="file" id="electric_terminal_photo"  class="form-control-file {{ $errors->has('electric_terminal_photo') ? ' has-error' : '' }}" name="electric_terminal_photo">
                                @if ($errors->has('electric_terminal_photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('electric_terminal_photo') }}</strong>
                                    </span>
                                @endif

                                <div class="col-md-8 offset-md-6">
                                    <img src="" id="img_electric_terminal_photo" class="w-100">
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            

                            <div class="col-md-6 offset-md-3">
                            <label for="profile_photo" class="col-md-8 col-form-label ">{{ __('Choisir une photo de profil') }}<span class="red">*</span></label>
                                <input id="profile_photo" type="file" class="form-control-file {{ $errors->has('profile_photo') ? ' has-error' : '' }}" name="profile_photo" required>

                                @if ($errors->has('profile_photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profile_photo') }}</strong>
                                    </span>
                                @endif

                                <div  class="col-md-8 offset-md-6">
                                    <img src="" id="img_profile_photo" class="w-100">
                                </div>

                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-2 offset-md-5 ">
                                <button type="submit" class="btn btn-info">
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
</div>-
@endsection('content')
@section('JS')

<script src="{{asset('js/form.js')}}"> </script> 
@endsection