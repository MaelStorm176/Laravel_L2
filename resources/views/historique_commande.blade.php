@extends('layouts.app')
@section('content')
    <div class="container" style="padding-bottom: 3em">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Historique de vos commandes</div>
                    @auth
                        @if(Auth::user()->id==1 && Auth::user()->username=="admin")
                            <div id="tag_container">
                                @include('presult')
                            </div>
                       @else
                            <div id="tag_container">
                                @include('presult2')
                            </div>
                        @endif
                        @if(Auth::user()->id==1 && Auth::user()->username=="admin")
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Commandes en cours</div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Détails commande</th>
                            <th scope="col">Client</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Statut Paiement</th>
                            <th scope="col">Heure de la commande</th>
                            <th scope="col">Statut Préparation</th>
                        </tr>
                        </thead>
                        <tbody id="afficher_commande">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else

    @endif
    <div class="toast fixed-bottom" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
        <div class="toast-header">
            <!-- <img src="..." class="rounded mr-2" alt="..."> !-->
            <strong class="mr-auto">Information</strong>
            <small class="text-muted"><1 min</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="input-toast">
        </div>
    </div>

    <!-- RECEPTION DE MESSAGE -->
    @if(session()->get('message'))
        <input type="hidden" id="message" value="{{session()->get('message')}}">
        <script>
            window.onload=function()   {
                const message = $('#message').val();
                $('#input-toast').text(message);
                $('.toast').toast('show').slideDown();
            }
        </script>
    @endif
    @endauth

@endsection

<script>
    function myFunction() {
        var x = document.getElementById("myDIV");
        if (x .style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>


<script type="text/javascript">
    function charger_commande(){
        setTimeout( function(){
            // on lance une requête AJAX
            $.ajax({
                url : "afficher_commande",
                type : 'GET',
                success : function(html){
                    $('#afficher_commande').html(html); // on veut ajouter les nouveaux messages au début du bloc #messages
                }
            });

            charger_commande(); // on relance la fonction

        }, 10000); // on exécute le chargement toutes les 5 secondes
    }

    charger_commande();

    function valider(id){
        $.ajax({
            url : 'valider',
            type : 'GET',
            dataType : 'html',
            data : {id:id},
            success : function(code_html, statut){
                //$(code_html).appendTo("#commentaires"); // On passe code_html à jQuery() qui va nous créer l'arbre DOM !
                $('tr[id="'+id+'"]').remove();
                $('#input-toast').text('Commande validée (Payement + préparation) !');
                $('.toast').toast('show').slideDown();
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },

            complete : function(resultat, statut){

            }

        });
    }

    function afficher(id) {
        var div = $('div[id="div_'+id+'"]');
        if (div.css("display") === "none") {
            div.css("display","block");
        } else {
            div.css("display","none");
        }
    }
</script>

