<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <meta charset="uft-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../img/favicon.png">
        <title>ADMINISTRATION</title>
    </head>
    <style type="text/css">
        @media only screen and (min-width:1050px) {
            nav  {
                position: fixed;
                top:0;
                left:0;
                min-height: 100vh!important;
                height:100%;
                width:25%;
                
            }
            #contenu{
                margin-left: 25%;
                width:75%;
            }
            #foot{
                position: fixed;
                bottom: 2rem;
                left:0;
                width:25%;
            }
        }
        @media only screen and (max-width:1050px) {
            nav   {
                position: none;
                min-height: none;
                height:auto;
                position: relative;
                width: 100%;
            }
            #contenu{
                margin-left: 0%;
                width:100%;
            }

            #foot{
                position:none;
                width: 100%;

            }
        }
    </style>
    <body>
        <?php $droits = \App\Http\Controllers\Admin::afficher_droits(); ?>
        @foreach($droits as $key)
        @endforeach
        <div class="container-fluid">
            <section class="row">
                <nav class="nav flex-column bg-dark px-0" style="z-index:2000;">
                    <div class="bg-success text-center w-100 py-3 border border-dark border-top-0 border-left-0">
                        <a class="nav-link text-white" href="{{route('admin')}}">ADMINISTRATION</a>
                    </div>
                    <div class="list-group">
                        @if($key->parametre)
                            <a href="{{ route('adm_general')}}" class="nav-link list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                <span class="fas fa-sliders-h mt-1 mr-1"></span>
                                GENERAL
                            </a>                     
                            <div class="dropright">
                                <a href="#" class="nav-link list-group-item list-group-item-action dropdown-toggle py-3 bg-dark text-white rounded-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-cog mt-1 mr-1"></span>
                                    SECONDAIRE
                                </a>
                                <div class="dropdown-menu bg-success rounded-0 mr-0">
                                    <!-- Sous menu  -->
                                    <div class="list-group">
                                        <a href="{{route('adm_page_accueil')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                            <span class="fas fa-home mt-1 mr-1"></span>
                                            Page Accueil
                                        </a>
                                        <a href="{{route('adm_engagements')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                            <span class="fas fa-object-group mt-1 mr-1"></span>
                                            Engagements
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($key->restauration)
                            <div class="dropright">
                                <a href="#" class="nav-link list-group-item list-group-item-action dropdown-toggle py-3 bg-dark text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-clipboard-list mt-1 mr-1"></span>
                                    COMMANDES
                                </a>
                                <div class="dropdown-menu bg-success rounded-0 mr-0">
                                    <!-- Sous menu  -->
                                    <div class="list-group">
                                        <a href="{{route('adm_commandes')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                            <span class="fas fa-hourglass-half mt-1 mr-1"></span>
                                            Commandes en cours
                                        </a>
                                        <a href="{{route('adm_historique_commandes')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                            <span class="fas fa-hourglass-end mt-1 mr-1"></span>
                                            Commandes terminées
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropright">
                                <a href="#" class="nav-link list-group-item list-group-item-action dropdown-toggle py-3 bg-dark text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-receipt mt-1 mr-1"></span>
                                    CARTE
                                </a>
                                <div class="dropdown-menu bg-success rounded-0 mr-0">
                                    <!-- Sous menu  -->
                                    <div class="list-group">
                                        <a href="{{route('adm_menus')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                            <span class="fas fa-list-alt mt-1 mr-1"></span>
                                            Menus
                                        </a>
                                        <a href="{{route('adm_articles')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                            <span class="fas fa-pizza-slice mt-1 mr-1"></span>
                                            Articles
                                        </a>
                                        <a href="{{route('adm_codes')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                            <span class="fas fa-gift mt-1 mr-1"></span>
                                            Codes Promos
                                        </a>
                                        <a href="{{route('adm_promotions')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                            <span class="fas fa-percent mt-1 mr-1"></span>
                                            Promotions
                                        </a>
                                        <a href="{{route('adm_ingredients')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                            <span class="fas fa-pizza-slice mt-1 mr-1"></span>
                                            Ingredients
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropright">
                                <a href="#" class="nav-link list-group-item list-group-item-action dropdown-toggle py-3 bg-dark text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-calendar-alt mt-1 mr-1"></span>
                                    PLANNING
                                </a>
                                <div class="dropdown-menu bg-success rounded-0 mr-0">
                                    <!-- Sous menu  -->
                                    <div class="list-group">
                                        <a href="{{route('adm_horaires')}}" class="nav-link list-group-item list-group-item-action py-3 bg-dark text-white">
                                            <span class="fas fa-clock mt-1 mr-1"></span>
                                            Page horaires
                                        </a>
                                        <a href="{{route('adm_creneaux')}}" class="nav-link list-group-item list-group-item-action py-3 bg-dark text-white">
                                            <span class="fas fa-calendar-check mt-1 mr-1"></span>
                                            Créneaux de réservation
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if($key->moderation)
                            <a href="{{route('adm_avis')}}" class="nav-link list-group-item list-group-item-action py-3 bg-dark text-white">
                                <span class="fas fa-comment mt-1 mr-1"></span>
                                AVIS
                            </a>
                        @endif
                        @if($key->newsletter)
                            <a href="{{route('adm_newsletter')}}" class="nav-link list-group-item list-group-item-action py-3 bg-dark text-white">
                                <span class="fas fa-envelope-square mt-1 mr-1"></span>
                                NEWSLETTER
                            </a>
                        @endif
                        @if($key->moderation || $key->upgrade)
                            <div class="dropright">
                                <a href="#" class="nav-link list-group-item list-group-item-action dropdown-toggle py-3 bg-dark text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="fas fa-user mt-1 mr-1"></span>
                                    UTILISATEURS
                                </a>
                                <div class="dropdown-menu bg-success rounded-0 mr-0">
                                    <!-- Sous menu  -->
                                    <div class="list-group">
                                        @if($key->moderation)
                                            <a href="{{route('adm_informations')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                                <span class="fas fa-info-circle mt-1 mr-1"></span>
                                                INFORMATIONS
                                            </a>
                                            <a href="{{route('adm_expulsions')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                                <span class="fas fa-user-alt-slash mt-1 mr-1"></span>
                                                EXPULSIONS
                                            </a>
                                        @endif
                                        @if($key->upgrade)
                                            <a href="{{route('adm_droits')}}" class="list-group-item list-group-item-action py-3 bg-dark text-white rounded-0">
                                                <span class="fas fa-user-plus mt-1 mr-1"></span>
                                                DROITS
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        <a href="{{route('/')}}" class="nav-link list-group-item list-group-item-action py-3 rounded-0 bg-dark text-white">
                            <span class="fas fa-arrow-alt-circle-left mt-1 mr-1"></span>
                            RETOUR AU SITE
                        </a>
                    </div>
                    <div id="foot" class="text-center text-white bg-secondary mb-3 p-3 border border-dark border-top-0 border-left-0">
                        © 2020 Copyright: {{config('app.url')}}
                    </div>
                </nav>
                <div id="contenu" class="px-0">
                    <div class="bg-dark py-4 w-100 text-center text-info mb-3">@yield('titre')</div>
                    @yield('contenu')
                </div>
            </section>
        </div>
        <script type="text/javascript" src="{{asset('js/dist/Notifier.min.js')}}"></script>
        @if(Session::get('errors'))
            @foreach($errors->all() as $error)
                <script>$(function (){ erreur('{{$error}}')});</script>
            @endforeach
        @endif
        @if(session()->has('message'))
            <script>$(function (){ success('{{session()->get('message')}}')});</script>
        @endif
        @if(session()->has('erreur'))
            <script>$(function (){ erreur('{{session()->get('erreur')}}')});</script>
        @endif
        <script>
            function success(message) {
                var notifier = new Notifier();
                notifier.notify("success", message);
            }

            function erreur(message) {
                var notifier = new Notifier();
                notifier.notify("error", message);
            }
        </script>
    </body>
@yield('script')
</html>
