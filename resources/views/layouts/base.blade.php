<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <script src="{{ asset('js/app.js') }}"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <meta charset="uft-8">
        <link rel="shortcut icon" href="../img/favicon.png">
        <title>NOM PIZZERIA</title>
    </head>
    <body>


        <header class="header mb-0 p-5" style="background:url('../img/banniere.jpg');">
            <div class="container">


                        <img src="../img/ban.png" style="max-width: 80%;">
                        <!--
                        <div class="jumbotron mb-0 text-center">
                            <h2 class="mb-0">LOGO PIZZERIA</h2>
                        </div>
                        -->
                    </div>
                    @guest
                        @if(Session::get('errors'))
                            @if ($errors->login)
                                @foreach($errors->all() as $error)
                                    <div class="col-lg-3 offset-lg-1">
                                        <div class="toast mt-5" data-autohide="false">
                                            <div class="toast-header bg-danger text-white mt-1">
                                                <span class="fas fa-exclamation-triangle mt-n1 mr-2"></span>
                                                <strong class="mr-auto">ERREUR</strong>
                                                <small>A l'instant</small>
                                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="toast-body">
                                                {{ $error }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    @endguest
                </section>
            </div>
        </header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3 rounded-0">
            <div class="container container-nav">

                <a class="navbar-brand" href="{{ route('/') }}">NOM PIZZERIA</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('pizza_all')}}">Notre Carte</a>
                        </li>
                        <li class="nav-item">

                            <a class="nav-link" href="{{route('horaires')}}">Nos Horaires</a>
                        </li>
                        <li class="nav-item">

                            <a class="nav-link" href="{{route('engagements')}}">Nos Engagements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('avis')}}">Avis</a>
                        </li>
                    </ul>
                    @guest
                        <div class="navbar-right">
                            <button type="button" id="btn_modal_connexion" class="btn btn-outline-info navbar-btn" data-toggle="modal" data-target="#connexionModal"><span class="fas fa-user mr-2"></span>Connexion</button>
                            <button type="button" id="btn_modal_register" class="btn btn-outline-warning navbar-btn" data-toggle="modal" data-target="#inscriptionModal"><span class="fas fa-pen-alt mr-2"></span>Inscription</button>
                        </div>
                    @endguest
                    @auth
                        <div class="navbar-right">
                            <div class="btn-group" role="group" aria-label="Basic example">
                            <div class="dropdown">
                                <button class="btn btn-outline-info dropdown-toggle navbar-btn mr-1" type="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-user-circle mr-2"></span>{{ Auth::user()->username }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="{{route('panier')}}"><span class="fas fa-shopping-cart mr-2"></span>Mon Panier (0)</a>
                                    <a class="dropdown-item" href="{{route('historique_commande')}}"><span class="fas fa-store mr-2"></span>Mes Commandes</a>
                                    <a class="dropdown-item" href="{{ route('parametres') }}"><span class="fas fa-cogs mr-2"></span>Mes Paramères</a>
                                </div>
                            </div>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                 <button type="button" class="btn btn-outline-danger navbar-btn"><span class="fas fa-door-open mr-2"></span>{{ __('Logout') }}</button>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
        @yield('content')
        <footer class="bg-dark page-footer py-3 text-white text-center">
            © 2020 Copyright:
            <a href="#">LIEN DU SITE</a>
        </footer>
        @guest
            <!-- Modal Connexion -->
            <div class="modal fade" id="connexionModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Connecte-toi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="inputEmail1">E-mail</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1">Mot de passe</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                                <button type="submit" class="btn btn-primary">Connexion</button>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Mot de passe oublié ?
                                </a>
                            @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal Inscription -->
            <div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-warning text-white">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Inscris-toi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="username">{{ __('Pseudonyme') }}</label>
                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="first_name">{{ __('Prénom') }}</label>
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="last_name">{{ __('Nom') }}</label>
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('Adresse e-mail') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('Mot de passe') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">{{ __('Confirmation du mot de passe') }}</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                                <button type="submit" class="btn btn-warning">{{ __('Register') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endguest
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });

            $(document).ready(function(){
                $('.toast').toast('show');
            });
        </script>
    </body>
</html>
