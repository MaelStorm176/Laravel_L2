@extends('layouts.adm')
@section('titre')
    PLANNING<span class="fas fa-calendar-alt mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Horaires<span class="fas fa-clock mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Midi</th>
                                    <th scope="col">Soir</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($horaires as $key)
                                    <tr>
                                        <th class="bg-dark text-info align-middle" scope="row">{{$key->jour}}</th>
                                        <td id="{{$key->jour}}_midi" @if($key->midi == 'Fermé') class="bg-danger text-white align-middle" @else class="bg-success text-white align-middle" @endif>{{$key->midi}}</td>
                                        <td id="{{$key->jour}}_soir" @if($key->soir == 'Fermé') class="bg-danger text-white align-middle" @else class="bg-success text-white align-middle" @endif>{{$key->soir}}</td>
                                        <td class="bg-dark"><span class="fas fa-edit btn text-info p-1 m-0" id="bouton_ajout" onclick="modifier('{{$key->jour}}',{{$key->id}})" data-toggle="modal" data-target="#exampleModalCenterCode"></span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Péridode de fermeture<span class="fas fa-door-closed mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Date début</th>
                                    <th scope="col">Date fin</th>
                                    <th scope="col">Motif</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fermetures as $key)
                                    <tr id="fermeture{{$key->id}}">
                                        <td class="align-middle">{{$key->date_debut}}</td>
                                        <td class="align-middle">{{$key->date_fin}}</td>
                                        <td class="align-middle">{{$key->motif}}</td>
                                        <td class="align-middle"><span class="fas fa-trash-alt btn" onclick="fermeture_supprimer({{$key->id}})"></span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary text-white w-100" data-toggle="modal" data-target="#ajoutModalCenterCode">
                            AJOUTER UNE PERIODE DE FERMETURE
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Jours Fériés Ouvert<span class="fas fa-calendar-day mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Midi</th>
                                    <th scope="col">Soir</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feriees as $key)
                                    <tr id="feriee{{$key->id}}">
                                        <td class="align-middle">{{$key->jour}}</td>
                                        <td @if($key->midi == 'Fermé') class="bg-danger text-white align-middle" @else class="bg-success text-white align-middle" @endif>{{$key->midi}}</td>
                                        <td @if($key->soir == 'Fermé') class="bg-danger text-white align-middle" @else class="bg-success text-white align-middle" @endif>{{$key->soir}}</td>
                                        <td class="align-middle"><span class="fas fa-trash-alt btn" onclick="feriee_supprimer({{$key->id}})"></span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary text-white w-100" data-toggle="modal" data-target="#ajoutFModalCenterCode">
                            AJOUTER UN JOUR FERIE
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<!-- MODAL MODIFICATION HORAIRES -->
<div class="modal fade" id="exampleModalCenterCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLongTitleCode">Modifier un horaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0" action="{{ route('adm_horaires.modif') }}" id="formucode" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <table class="table table-bordered text-center">
                        <thead class="bg-primary text-white ">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Midi</th>
                                <th scope="col">Soir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th id="jour_modif" class="bg-secondary text-white align-middle" scope="row"></th>
                                <td><input name="midi_modif" id="midi_modif" class="form-control" placeholder="Entrez un horaire" required></td>
                                <td><input name="soir_modif" id="soir_modif" class="form-control" placeholder="Entrez un horaire" required></td>
                                <input name="id_modif" id="id_modif" type="hidden" value="">
                            </tr>
                        </tbody>
                    </table>
                </div>    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" id="upload" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL AJOUT PERIODE FERMETURE -->
<div class="modal fade" id="ajoutModalCenterCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLongTitleCode">Ajouter une période de fermeture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0" action="{{route('adm_fermeture_ajout')}}">
                <div class="modal-body">
                    <section class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="dateDeb">Date de début (inclus)</label>
                            <input type="date" id="dateDeb" name="dateDeb" class="form-control" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="dateFin">Date de fin (inclus)</label>
                            <input type="date" id="dateFin" name="dateFin" class="form-control" required>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="motif">Motif</label>
                            <input type="text" id="motif" name="motif" class="form-control" required>
                        </div>
                    </section>
                </div>    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" id="upload" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL AJOUT JOUR FERIEE -->
<div class="modal fade" id="ajoutFModalCenterCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLongTitleCode">Ajouter un jour fériée</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0" action="{{route('adm_feriee_ajout')}}">
                <div class="modal-body">
                    <section class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="jour">Date</label>
                            <input type="date" id="jour" name="jour" class="form-control" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="midi">Midi</label>
                            <input type="text" id="midi" name="midi" class="form-control" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="soir">Soir</label>
                            <input type="text" id="soir" name="soir" class="form-control" required>
                        </div>
                    </section>
                </div>    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" id="upload" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function modifier(nom,id){
        $('#jour_modif').html(nom);
        $('#id_modif').val(id);
    }

    function feriee_supprimer(id) {
        var dummy = Date.now();
        $.ajax({
            url : 'feriee_supprimer',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                $('tr[id="feriee'+id+'"]').remove();
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }

    function fermeture_supprimer(id) {
        var dummy = Date.now();
        $.ajax({
            url : 'fermeture_supprimer',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                $('tr[id="fermeture'+id+'"]').remove();
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }
</script>