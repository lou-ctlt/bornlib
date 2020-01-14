@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mes infos') }}</div>


        <!-- START Form -->
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf

                        <div class="form-group row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="car" value="1" name="car">
                                <label class="form-check-label" for="car">J'ai une voiture, je cherche une borne.</label>
                            </div>
                        </div>

                        <div class="form-group row" id="license-plate">
                            <label for="license-plate" class="col-md-4 col-form-label text-md-right">{{ __('Numéro d\'immatriculation') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="license-plate">

                                @error('license-plate')
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
                                <input type="file" class="form-control-file" name="electric_terminal_photo">

                                @error('electric_terminal_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile_photo" class="col-md-4 col-form-label text-md-right">{{ __('Choisir une photo de profil') }}</label>

                            <div class="col-md-6">
                                <input id="profile_photo" type="file" class="form-control-file @error('profile_photo') is-invalid @enderror" name="profile_photo" required>

                                @error('profile_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
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
</div>
@endsection