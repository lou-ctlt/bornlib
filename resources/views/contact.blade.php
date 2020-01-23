@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-md-8">
                <!-- START Contact Form -->
                <form class="py-5">
                    <div class="card border-success rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-success text-white text-center py-2">
                                <h3><i class="fa fa-envelope"></i>Nous contacter</h3>
                                <p class="m-0">Une question ? Une suggestion ? On vous écoute !</p>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Votre nom" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Votre prénom" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                    </div>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Votre adresse email" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                    </div>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet de votre message" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                    </div>
                                    <textarea class="form-control" id="message" name="message" placeholder="Votre message" required></textarea>
                                </div>
                            </div>

                            <div class="text-center">
                                <input id="sendmail" type="button" value="Envoyer" class="btn btn-block btn-success text-white rounded-0 py-2">
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END Contact Form -->
        </div>
    </div>
</div>


@endsection


@section('JS')
    <script src="{{ asset('js/form.js') }}" defer></script>
@endsection
