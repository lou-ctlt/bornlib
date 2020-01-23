@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-white font-bornlib font-bold">{{ __('S\'inscrire') }}</div>

        <!-- START Form -->
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <!--NOM-->
                            <div class="form-group col-md-6">
                                <label for="lastname" class="col-md-4 col-form-label">{{ __('Nom') }}<span class="text-danger">*</span></label>
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="firstname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--PRENOM-->
                            <div class="form-group col-md-6">
                                <label for="firstname" class="col-md-4 col-form-label">{{ __('Prénom') }}<span class="text-danger">*</span></label>
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <!--EMAIL-->
                            <div class="form-group col-md-6">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse e-mail') }}<span class="text-danger">*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <!--MOT DE PASSE-->
                                <div class="form-group">
                                    <label for="password" class="col-md-4 col-form-label">{{ __('Mot de passe') }}<span class="text-danger">*</span></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    <small class="font-italic">Minimum 8 caractères.</small>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!--CONFIRMATION DU MOT DE PASSE-->
                                <div class="form-group">
                                    <label for="password-confirm" class="col-md-12 col-form-label">{{ __('Confirmez le mot de passe') }}<span class="text-danger">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--ADRESSE-->
                            <div class="form-group col-md-6">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Adresse postale') }}<span class="text-danger">*</span></label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"value="{{ old('address') }}" required autocomplete="address" autofocus>
                                <small class="font-italic">Ex: 1 Cours Pasteur 33000 Bordeaux ( sans accent )</small>
                                @if (!empty($addressError))
                                    <div class="alert alert-danger text-center">
                                        <span class="help-block">
                                            <strong>{{ $addressError }}</strong>
                                        </span>
                                    </div>
                                @endif
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!--NUMERO DE CARTE D'IDENTITE-->
                            <div class="form-group col-md-6">
                                <label for="ID_number" class="col-md-4 col-form-label text-md-right">{{ __('Numéro de CNI') }}<span class="text-danger">*</span></label>
                                <input id="ID_number" type="text" class="form-control @error('ID_number') is-invalid @enderror" name="ID_number" required>
                                <small class="font-italic">Le numéro de carte d'identité doit comporter 12 caractères.</small>

                                @error('ID_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <!--CHOIX OPTION VOITURE-->
                            <div class="form-group col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="car" value="1" name="car">
                                    <label class="form-check-label" for="car">J'ai une voiture, je cherche une borne.</label>
                                </div>
                            </div>
                            <!--NUMERO DE PLAQUE D'IMMATRICULATION-->
                            <div class="form-group col-md-8 d-flex">
                                <label for="license-plate" class="col-md-4 col-form-label">{{ __('Numéro d\'immatriculation') }}</label>
                                <div class="flex-direction-column">
                                    <input type="text" class="form-control" name="license_plate" id="license_plate">
                                    <small class="font-italic">Ex: AA-000-AA / 0AA00 / 00AA00 / 000AA00 / 0000AA00</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!--CHOIX OPTION BORNE-->
                            <div class="form-group col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terminal" value="1" name="electric_terminal">
                                    <label class="form-check-label" for="terminal">Je propose l'accès à ma borne.</label>
                                </div>
                            </div>
                            <!--PHOTO DE LA BORNE-->
                            <div class="form-group col-md-8 d-flex">
                                <label for="electric_terminal_photo" class="col-md-4 col-form-label">{{ __('Choisir une photo de ma borne') }}</label>
                                <input type="file" id="electric_terminal_photo"  class="form-control-file" name="electric_terminal_photo">
                            </div>
                            <div class="col-md-8 offset-md-4">
                                <img src="" id="img_electric_terminal_photo" class="w-100">
                            </div>
                        </div>

                        <hr>
                        <!--PHOTO DE PROFIL-->
                        <div class="form-group row">
                            <label for="profile_photo" class="col-md-4 col-form-label text-md-right">{{ __('Choisir une photo de profil') }}<span class="text-danger">*</span></label>

                            <div class="col-md-6">
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
                        <!--CGU-->
                        <div class="form-group row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cgu" value="1" name="cgu" required>
                                <label class="form-check-label" for="cgu">Je comprends et j'accepte les <a href="storage/cgu.pdf" target="blank">conditions générales d'utilisation</a>.<span class="text-danger">*</span></label>
                            </div>
                        </div>

                        <div class="row">
                            <small class="text-danger font-italic">* Champs obligatoires.</small>
                        </div>
                        <!--BOUTON D'ENVOI DU FORMULAIRE-->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success" id="SubmitSecondForm">
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

@section('JS')
    <script src="{{ asset('js/form.js') }}" defer></script>
@endsection
