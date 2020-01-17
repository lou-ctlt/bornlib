@extends('layouts.app')

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center">{{ __('INFORMATIONS UTILISATEUR') }}</div>
        <!-- START Form -->
                <div class="card-body">

                    
                    <form method="POST" action="{{route('UpdateUser')}} ">
                        @csrf
                        <div class="form-group row ">
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="lastname" class="col-md-8 col-form-label ">{{ __('Nom') }}</label>
                                <input id="lastname" type="text" class="form-control {{ $errors->has('lastname') ? 'has-error' : ' '}}" name="lastname" value=""  autocomplete="lastname" autofocus>
                         
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
                                <input id="firstname" type="text" class="form-control {{ $errors->has('firstname') ? 'has-error' : ' '}}" name="firstname" value=""  autocomplete="firstname" autofocus>
                               
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
                                <input id="email" type="text" class="form-control {{ $errors->has('email') ? 'has-error' : ' '}} " name="email" value="" >
                               
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
                                <input id="address" type="text" class="form-control {{ $errors->has('address') ? 'has-error' : ' '}}" name="address"  autocomplete="new-address" value="" >
                               
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
                                <input id="ID_number" type="text" class="form-control {{ $errors->has('ID_number') ? 'has-error' : ' '}}" name="ID_number"  autocomplete="new-ID_number" value="" >
                             
                                @if ( $errors->has('ID_number') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ID_number') }}</strong> 
                                    </span>
                                @endif

                            </div>
                        </div>
                   
                        <div class="form-group row">
                            <div class="form-check col-md-6 offset-md-3">
                                <input class="form-check-input" type="checkbox" id="car" value="" name="car">
                                <label class="form-check-label" for="car">J'ai une voiture, je cherche une borne.</label>
                            </div>
                        </div>
                        <div class="form-group row" id="license-plate">
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="license-plate" class="col-md-8 col-form-label">{{ __('Numéro d\'immatriculation') }}</label>
                                <input type="text" class="form-control {{ $errors->has('license_plate') ? 'has-error' : ' '}}" name="license-plate">
                          
                                @if ( $errors->has('license-plate') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('license-plate') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-check col-md-6 offset-md-3">
                                <input class="form-check-input " type="checkbox" id="terminal" value="" name="electric_terminal">
                                <label class="form-check-label" for="terminal">Je propose l'accès à ma borne.</label>
                            </div>
                        </div>

                        <div class="form-group row" id="electric_terminal_photo">
                            
                            <div class="col-md-6 offset-md-3">
                                <img src="" alt="">
                                <label for="electric_terminal_photo" class="col-md-8 col-form-label">{{ __('Changer la photo de la borne') }}</label>
                                <input type="file" class="form-control-file {{ $errors->has('electric_terminal_photo') ? 'has-error' : ' '}}" name="">
                             
                                @if ( $errors->has('license-plate') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('electric_terminal_photo') }}</strong> 
                                    </span>
                                @endif
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            
                            <div class="col-md-6 offset-md-3">
                                <img src="" alt="">  
                                <label for="profile_photo" class="col-md-8 col-form-label">{{ __('Changer la photo du profil') }}</label>
                                <input id="profile_photo" type="file" class="form-control-file @error('profile_photo') is-invalid @enderror" name="profile_photo" >
                            
                                
                                
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