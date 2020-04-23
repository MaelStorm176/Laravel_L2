<!DOCTYPE HTML>
<html lang="fr">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <meta charset="uft-8">
        <link rel="shortcut icon" href="img/favicon.png">
        <title>NOM PIZZERIA</title>
    </head>
    <body>

        <header class="header mb-0 p-5" style="background:url('img/banniere.jpg');">
            <div class="container">
                <section class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="jumbotron mb-0 text-center">
                            <h2 class="mb-0">LOGO PIZZERIA</h2>     
                        </div>
                    </div>
                </section>
            </div>
        </header>
            
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3 rounded-0">
            <div class="container container-nav">
                <a class="navbar-brand" href="accueil">NOM PIZZERIA</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="carte">Notre Carte</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="horaires">Nos Horaires</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="engagements">Nos Engagements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="avis">Avis</a>
                        </li>
                    </ul>      
                    <div class="navbar-right">
                        <button type="button" class="btn btn-outline-info navbar-btn" data-toggle="modal" data-target="#connexionModal"><span class="fas fa-user mr-2"></span>Connexion</button>
                        <button type="button" class="btn btn-outline-warning navbar-btn" data-toggle="modal" data-target="#inscriptionModal"><span class="fas fa-pen-alt mr-2"></span>Inscription</button>
                    </div>
                </div>
            </div>
        </nav>
        @yield('content')
        <footer class="bg-dark page-footer py-3 text-white text-center">
            © 2020 Copyright:
            <a href="#">LIEN DU SITE</a>
        </footer>
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
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputEmail1">E-mail</label>
                                <input type="email" class="form-control" id="inputEmail1">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword1">Mot de passe</label>
                                <input type="password" class="form-control" id="inputPassword1">
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                        <button type="submit" class="btn btn-primary">Connexion</button>
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
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="inputNom">Nom</label>
                                <input type="text" class="form-control" id="inputNom">
                            </div>
                            <div class="form-group">
                                <label for="inputPrenom">Prénom</label>
                                <input type="text" class="form-control" id="inputPrenom">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail2">E-mail</label>
                                <input type="email" class="form-control" id="inputEmail2">
                              </div>
                            <div class="form-group">
                                <label for="inputPassword1">Mot de passe</label>
                                <input type="password" class="form-control" id="inputPassword2">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3">Retape ton mot de passe</label>
                                <input type="password" class="form-control" id="inputPassword3">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                            <button type="button" class="btn btn-warning">Inscription</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        </script>
    </body>
</html>