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
                                <input id="lastname" type="text" class="form-control {{ $errors->has('lastname') ? 'has-error' : ' '}}" name="lastname" value="{{ $user->lastname }}" required autocomplete="lasstname" autofocus>
                            <!--    @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror-->
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
                                <input id="firstname" type="text" class="form-control {{ $errors->has('firstname') ? 'has-error' : ' '}}" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname" autofocus>
                               <!-- @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror-->
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
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'has-error' : ' '}} " name="email" value="{{ $user->email }}" >
                               <!-- @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror-->
                                @if ( $errors->has('email') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>
                     <!--     <div class="form-group row">
                            
                          <div class="col-md-6 offset-md-3">
                                <label for="password" class="col-md-8 col-form-label">{{ __('Mot de passe') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-3">
                                <label for="password-confirm" class="col-md-8 col-form-label">{{ __('Comfirmez le mot de passe') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> -->
                        <div class="form-group row">
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="address" class="col-md-8 col-form-label ">{{ __('Adresse postale') }}</label>
                                <input id="address" type="text" class="form-control {{ $errors->has('address') ? 'has-error' : ' '}}" name="address" required autocomplete="new-address" value="{{ $user->address }}" >
                               <!-- @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
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
                                <input id="ID_number" type="text" class="form-control {{ $errors->has('ID_number') ? 'has-error' : ' '}}" name="ID_number" required autocomplete="new-ID_number" value="{{ $user->ID_number }}" >
                              <!--  @error('ID_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror-->
                                @if ( $errors->has('ID_number') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ID_number') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>
                    <!--   <div class="form-group row">
                            <div class="form-check">
                                <input class="form-check-input @error('cgu') is-invalid @enderror" type="checkbox" id="cgu" value="cgu" required autocomplete="cgu" autofocus>
                                <label class="form-check-label" for="cgu">Je comprends et j'accepte les <a href="#" target="blank">conditions générales d'utilisation</a>.</label>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <div class="form-check col-md-6 offset-md-3">
                                <input class="form-check-input" type="checkbox" id="car" value="{{ $user->car }}" name="car">
                                <label class="form-check-label" for="car">J'ai une voiture, je cherche une borne.</label>
                            </div>
                        </div>
                        <div class="form-group row" id="license-plate">
                            
                            <div class="col-md-6 offset-md-3">
                                <label for="license-plate" class="col-md-8 col-form-label">{{ __('Numéro d\'immatriculation') }}</label>
                                <input type="text" class="form-control {{ $errors->has('license_plate') ? 'has-error' : ' '}}" name="license-plate">
                            <!--    @error('license-plate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror-->
                                @if ( $errors->has('license-plate') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('license-plate') }}</strong> 
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="form-check col-md-6 offset-md-3">
                                <input class="form-check-input " type="checkbox" id="terminal" value="{{ $user->electric_terminal }}" name="electric_terminal">
                                <label class="form-check-label" for="terminal">Je propose l'accès à ma borne.</label>
                            </div>
                        </div>
                        <div class="form-group row" id="electric_terminal_photo">
                            
                            <div class="col-md-6 offset-md-3">
                                <img src="" alt="">
                                <label for="electric_terminal_photo" class="col-md-8 col-form-label">{{ __('Changer la photo de la borne') }}</label>
                                <input type="file" class="form-control-file {{ $errors->has('electric_terminal_photo') ? 'has-error' : ' '}}" name="">
                             <!--   @error('electric_terminal_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>electric_terminal_photo
                                @enderror-->
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
                            <!--     @error('profile_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror-->
                                @if ( $errors->has('license-plate') )
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profile_photo') }}</strong> 
                                    </span>
                                @endif
                                
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