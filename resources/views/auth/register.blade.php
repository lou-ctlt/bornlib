@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('S\'inscrire') }}</div>


        <!-- START Form -->
                <div class="card-body"> 
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="firstname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse e-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Comfirmez le mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Adresse postale') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="new-address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ID_number" class="col-md-4 col-form-label text-md-right">{{ __('Numéro de CNI') }}</label>

                            <div class="col-md-6">
                                <input id="ID_number" type="text" class="form-control @error('ID_number') is-invalid @enderror" name="ID_number" required autocomplete="new-ID_number">

                                @error('ID_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="car" value="1" name="car">
                                <label class="form-check-label" for="car">J'ai une voiture, je cherche une borne.</label>
                            </div>
                        </div>

                        <div class="form-group row" id="license_plate">
                            <label for="license-plate" class="col-md-4 col-form-label @error('license_plate') is-invalid @enderror">{{ __('Numéro d\'immatriculation') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="license_plate">

                                @error('license_plate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terminal" value="1" name="electric_terminal">
                                <label class="form-check-label" for="terminal">Je propose l'accès à ma borne.</label>
                            </div>
                        
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row" id="electric_terminal_photo">
                            <label for="electric_terminal_photo" class="col-md-4 col-form-label text-md-right">{{ __('Choisir une photo de ma borne') }}</label>

                            <div class="col-md-6">
                                <input type="file" class="form-control-file {{ $errors->has('electric_terminal_photo') ? ' has-error' : '' }}" name="electric_terminal_photo">

                                @if ($errors->has('electric_terminal_photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('electric_terminal_photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile_photo" class="col-md-4 col-form-label text-md-right">{{ __('Choisir une photo de profil') }}</label>

                            <div class="col-md-6">
                                <input id="profile_photo" type="file" class="form-control-file {{ $errors->has('profile_photo') ? ' has-error' : '' }}" name="profile_photo" required>

                                @if ($errors->has('profile_photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profile_photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cgu" value="1" name="cgu">
                                <label class="form-check-label" for="cgu">Je comprends et j'accepte les <a href="{{ asset('public/condition-generales-utilisation.pdf') }}" target="blank">conditions générales d'utilisation</a>.</label>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-info" id="SubmitSecondForm">
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
@endsection