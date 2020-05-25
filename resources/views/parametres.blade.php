@extends('layouts.base')
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-6">
                <div class="card border-one mb-3">
                    <div class="card-header bg-one text-one">Vérifie ton adresse mail<span class="fas fa-envelope float-right mt-1"></span></div>
                    <div class="card-body">
                        <p><em>Faire vérifier votre adresse e-mail vous permettra de poster des commentaires sur notre site.
                                Vous bénéficierez aussi de points vous offrant de nombreuses réductions et avantages !</em></p>
                        <form method="get" action="{{ route('conf_email') }}">
                            @if(auth::user()->role == 'verifie')
                                <span class="alert-success">Email vérifié !</span>
                            @else
                                <button type="submit" class="btn btn-one w-100">VALIDER</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-two mb-3">
                    <div class="card-header bg-two text-two">Changez votre mot de passe<span class="fas fa-lock float-right mt-1"></span></div>
                    <div class="card-body">
                        <p><em>Vous pouvez à tout moment réinitialiser le mot de passe de votre compte, pour cela nous avons besoin de votre adresse e-mail associée à votre compte. Nous vous enverrons ensuite un mail de confirmation afin que vous puissiez changer votre mot de passe.</em></p>

                        <a href="{{ route('password.request') }}" class="btn btn-one w-100">VALIDER</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-two mb-3">
                    <div class="card-header bg-two text-two">Mon profil<span class="fas fa-user-alt float-right mt-1"></span></div>
                    <div class="card-body">
                        <form method="get" action="{{ route('update') }}" class="mb-0">
                            @csrf
                            <div class="form-group">
                                <label for="username">{{ __('Pseudonyme') }}</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{auth::user()->username}}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="first_name">{{ __('Prénom') }}</label>
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ auth::user()->first_name }}" required autocomplete="first_name">

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="last_name">{{ __('Nom') }}</label>
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ auth::user()->last_name }}" required autocomplete="last_name">

                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" name="bouton" class="btn btn-one w-100">MODIFIER</button> 
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-one mb-3">
                    <div class="card-header bg-one text-one">Mon adresse enregistrée<span class="fas fa-map-pin float-right mt-1"></span></div>
                    <div class="card-body">
                    <form method="post" action="{{ route('modif_adresse') }}">
                    @csrf
                        <section class="row">
                            <div class="col-12 mb-3">
                                <label for="adresse">Adresse</label>
                                <input type="text" id="adresse" name="adresse" value="{{ $user->adresse }}" class="form-control">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-one w-100">MODIFIER</button> 
                            </div>
                        </section>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
