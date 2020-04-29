@extends('layouts.base')
@section('head')
    @include('toast')
@endsection
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3" data-toggle="modal" onclick="myFunction()">
                    <h5 class="mb-0">HISTORIQUE DE VOS COMMANDES</h5>
                </div>
                @auth
                    @if(Auth::user()->role=='admin')
                        <div id="tag_container">
                            @include('presult')
                        </div>
                    @else
                        <div id="tag_container">
                            @include('presult2')
                        </div>
                    @endif
                    @if(Auth::user()->role=='admin')
                        <div class="card bg-danger text-white text-center p-3 font-weight-bold font-italic mb-3">
                            <h5 class="mb-0">COMMANDE EN COURS</h5>
                        </div>
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
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
                            <tbody id="afficher_commande"></tbody>
                        </table>
                    @endif
            </div>
        </section>
    </div>
    @endauth
@endsection

<script type="text/javascript">

    function myFunction() {
        var x = document.getElementById("myDIV");
        if (x .style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }

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

