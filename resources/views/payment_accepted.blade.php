@auth
    <!DOCTYPE HTML>
    <html lang="fr" class="h-100">
        <head>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <!-- Popper JS -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <!-- Latest compiled JavaScript -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
            <meta charset="uft-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="shortcut icon" href="@yield('favi')img/favicon.png">
            <title>NOM PIZZERIA</title>
        </head>
        <body class="bg-secondary h-100">
        <div class="modal fade" id="paieModal" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title w-100 text-center" id="exampleModalCenterTitle">Paiement effectué</h5>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('historique_commande')}}" method="get">
                                <button type="submit" class="btn btn-primary w-100">
                                    RETOUR AU SITE
                                    <span class="fas fa-arrow-alt-circle-left mt-1 align-center"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
        </body>
    </html>
    <script>
        $('#paieModal').modal('show');
    </script>
@endauth
