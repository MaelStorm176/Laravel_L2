<?php use App\User; ?>
@extends('layouts.adm')
@section('titre')
    HISTORIQUE DES COMMANDES TERMINEES<span class="fas fa-hourglass-end mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Commandes Terminées<span class="fas fa-box-open mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Détail de la commande</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Statut Paiement</th>
                                    <th scope="col">Heure de la commande</th>
                                    <th scope="col">Heure de la fin de préparation</th>
                                    <th scope="col">Statut Préparation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td><button class="btn btn-outline-primary" onclick="afficher({{$value->id}})" data-toggle="modal" data-target="#commandesModal">{{ $value->num_commande }}</td>
                                        <td>{{ User::find($value->user_id)->email }}</td>
                                        <td>{{ $value->prix_total }}</td>
                                        <td>{{ $value->statut_pay }}</td>
                                        <td>{{ $value->created_at }}</td>
                                        <td>{{ $value->updated_at }}</td>
                                        <td>{{ $value->statut_prepa }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                {!! $products->render() !!}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<!-- Modal AFFICHER DETAILS -->
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
            url: "{{route('afficher_commande')}}",
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
</script>
