@extends('layouts.adm')
@section('titre')
    COMMANDE EN COURS<span class="fas fa-hourglass-half mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Commandes en Cours<span class="fas fa-dolly mt-1 float-right"></span></div>
                    <div class="card-body">
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
                    </div>
                </div>
                <button type="button" class="btn btn-primary text-white w-100 py-3 mb-3" onclick="charger_commande(0,0)">
                    RAFRAICHIR
                </button>
            </div>
        </section>
    </div>
@endsection
<!-- Modal AFFICHER DETAILS -->
<div class="modal fade" style="z-index:200000;" id="commandesModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Détail de la commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div id="append_here">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
            </div>
        </div>
    </div>
</div>
<script>

    function charger_commande(typeAction,idaffiche) {
        var dummy = Date.now();
        $.ajax({
            url: "../afficher_commande",
            type: 'GET',
            dataType: 'html',
            data: {dummy: dummy,typeAction:typeAction,idaffiche:idaffiche},
            success: function (code_html, statut) {
                if (typeAction==0)
                    $('#afficher_commande').html(code_html);
                else if (typeAction==1)
                    $('#append_here').html(code_html);
            },
            error: function (resultat, statut, erreur) {
                alert('Erreur avec la requete Ajax');
            },
        });
    }

    function valider(id){
        $.ajax({
            url : '../valider',
            type : 'GET',
            dataType : 'html',
            data : {id:id},
            success : function(code_html, statut){
                $('tr[id="'+id+'"]').remove();
                success('Commande validée (Payement + préparation) !');
            },
            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
            complete : function(resultat, statut){}
        });
    }

    function afficher(id) {
        charger_commande(1,id);
    }
</script>
