@extends('layouts.base')
@section('head')
    @include('toast')
@endsection
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                @auth
                    <div class="card border-one text-center font-weight-bold mb-3">
                        <div class="card-header bg-one text-one">
                            <h5 class="mb-0">HISTORIQUE DE VOS COMMANDES</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered mb-3 text-center">
                                <thead class="bg-tab text-tab">
                                    <tr>
                                        <th class="align-middle" scope="col">#</th>
                                        <th class="align-middle" scope="col">Détail de la commande</th>
                                        <th class="align-middle" scope="col">Prix</th>
                                        <th class="align-middle" scope="col">Statut Paiement</th>
                                        <th class="align-middle" scope="col">Heure de la commande</th>
                                        <th class="align-middle" scope="col">Heure de la fin de préparation</th>
                                        <th class="align-middle" scope="col">Statut Préparation</th>
                                    </tr>
                                </thead>          
                                <tbody>
                                    @if(!empty($products))
                                        @foreach ($products as $value)
                                            <tr>
                                                <td class="align-middle">{{ $value->id }}</td>
                                                <td class="align-middle">
                                                    <button class="btn btn-outline-primary" onclick="afficher({{$value->id}})" data-toggle="modal" data-target="#commandesModal">{{ $value->num_commande }}
                                                </td>
                                                <td class="align-middle">{{ $value->prix_total }}</td>
                                                <td class="align-middle">{{ $value->statut_pay }}</td>
                                                <td class="align-middle">{{ $value->created_at }}</td>
                                                @if($value->updated_at == NULL)
                                                    <td class="align-middle">Non déterminée</td>
                                                @else
                                                    <td class="align-middle">{{ $value->updated_at }}</td>
                                                @endif
                                                <td class="align-middle">{{ $value->statut_prepa }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if(!empty($value))
                                @if($value->user_id==Auth::user()->id)
                                    {!! $products->render() !!}
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="card border-two text-center font-weight-bold mb-3">
                        <div class="card-header bg-two text-two">
                            <div class="container">
                                <section class="row justify-content-between">
                                    <h5 class="mb-0 mt-1">
                                        VOS COMMANDES EN COURS
                                    </h5>
                                    <button class=" btn btn-one float-right" onclick="charger_commande2(0,0)">Rafraîchir</button>
                                </section>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered mb-3 text-center">
                                <thead class="bg-tab text-tab">
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
                @endauth
            </div>
        </section>
    </div>
@endsection
<!-- Modal Details Commande -->
<div class="modal fade" id="commandesModal" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
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
<script type="text/javascript">

        function afficher(id) {
            charger_commande(1,id);
        }

        function charger_commande(typeAction,idaffiche) {

            var dummy = Date.now();
            $.ajax({
                url: "afficher_commande",
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

        function charger_commande2(typeAction,idaffiche) {

            var dummy = Date.now();
            $.ajax({
                url: "afficher_commande2",
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
                url : 'valider',
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

                complete : function(resultat, statut){

                }

            });
        }



/*
        setTimeout( function(){
            // on lance une requête AJAX
            var dummy = Date.now();
            $.ajax({
                url : "afficher_commande",
                type : 'GET',
                dataType : 'html',
                data : {dummy:dummy},
                success : function(code_html,statut){
                    //$('#afficher_commande').append(code_html); // on veut ajouter les nouveaux messages au début du bloc #messages
                    alert(code_html);
                },
                error : function(resultat, statut, erreur){
                    alert('Erreur avec la requete Ajax');
                },
            });

            charger_commande(); // on relance la fonction

        }, 5000); // on exécute le chargement toutes les 10 secondes
        */
    </script>
