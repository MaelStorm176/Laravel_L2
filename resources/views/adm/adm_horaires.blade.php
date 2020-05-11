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
                                <td class="align-middle">17/05/2020</td>
                                <td class="align-middle">25/05/2020</td>
                                <td class="align-middle">Vacances</td>
                                <td class="align-middle"><span class="fas fa-edit btn"></span></td>
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
                                <td class="align-middle">17/05/2020</td>
                                <td class="bg-danger text-white align-middle">Fermé</td>
                                <td class="bg-success text-white align-middle">18h/22h</td>
                                <td class="align-middle"><span class="fas fa-edit btn"></span></td>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary text-white w-100" data-toggle="modal" data-target="#ajoutModalCenterCode">
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
            <form class="mb-0">
                <div class="modal-body">
                    <section class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="dateDeb">Date de début (inclus)</label>
                            <input type="date" id="dateDeb" class="form-control">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="dateFin">Date de fin (inclus)</label>
                            <input type="date" id="dateFin" class="form-control">
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="motif">Motif</label>
                            <input type="text" id="motif" class="form-control">
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
</script>