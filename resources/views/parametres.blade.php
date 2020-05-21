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
                                <button type="submit" class="btn btn-one w-100">Valider</button>
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

                        <a href="/password/reset" class="btn btn-one w-100">Valider</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-two mb-3">
                    <div class="card-header bg-two text-two">Mon profil<span class="fas fa-user-alt float-right mt-1"></span></div>
                    <div class="card-body">
                        <form method="get" action="{{ route('update') }}">
                            @csrf
                            <div class="modal-body">
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
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="bouton" class="btn btn-one">Confirmer les changements</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-one mb-3">
                    <div class="card-header bg-one text-one">Mes adresses enregistrées<span class="fas fa-map-pin float-right mt-1"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-0 text-center">
                            <thead class="bg-tab text-tab">
                                <tr>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Ville</th>
                                    <th scope="col">Code Postal</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>n°112 rue de la gare</td>
                                    <td>REIMS</td>
                                    <td>51100</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                                <tr>
                                    <td>n°112 rue de la gare</td>
                                    <td>REIMS</td>
                                    <td>51100</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                                <tr>
                                    <td>n°112 rue de la gare</td>
                                    <td>REIMS</td>
                                    <td>51100</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                                <tr>
                                    <td>n°112 rue de la gare</td>
                                    <td>REIMS</td>
                                    <td>51100</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
