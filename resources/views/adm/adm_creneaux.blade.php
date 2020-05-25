@extends('layouts.adm') 
@section('titre')
    CRENEAUX DE RESERVATIONS<span class="fas fa-hourglass-half mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-6">
                <?php use App\User; ?>
                <button type="button" class="btn btn-outline-primary w-100 mb-3" data-toggle="modal" data-target="#ajouter_creneaux">
                    Ajouter un créneau
                </button>
            </div>
            <div class="col-lg-6">
                <button type="button" class="btn btn-outline-primary w-100 mb-3" data-toggle="modal" data-target="#supprimer_jour">
                    Supprimer un jour
                </button>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Récapitulatif des créneaux<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Midi</th>
                                <th scope="col">Soir</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($jourv as $key)
                                <tr>
                                    <th class="bg-dark text-info align-middle" scope="row">{{$key->jour}}</th>
                                    <td id="{{$key->jour}}_midi">{{$key->deb_matin}} - {{$key->fin_matin}}</td>
                                    <td id="{{$key->jour}}_soir">{{$key->deb_soir}} - {{$key->fin_soir}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <button type="button" class="btn btn-outline-primary w-100 mb-3" data-toggle="modal" data-target="#reini_creneaux">
                    Réinitialiser les réservations
                </button>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Réservations à venir<span class="fas fa-calendar-check mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Midi</th>
                                <th scope="col">Soir</th>
                                <th scope="col">Client</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($table_creneaux as $key)
                                <?php
                                    $test = substr($key->creneaux,-7,2);
                                ?>
                                <tr>
                                    <th class="bg-dark text-info align-middle" scope="row">{{$key->jour}}</th>
                                    @if($test < 16)
                                        <td id="{{$key->jour}}_midi">{{$key->creneaux}}</td>
                                        <td id="{{$key->jour}}_soir" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);">x</td>
                                    @else
                                        <td id="{{$key->jour}}_midi" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);">x</td>
                                        <td id="{{$key->jour}}_soir">{{$key->creneaux}}</td>
                                    @endif
                                    <td id="{{$key->jour}}_soir">{{User::find($key->client)->first_name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<!-- MODAL REINITIALISATION -->
<div class="modal fade" id="reini_creneaux" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Réinitialiser un jour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('creneaux.reini')}}" method="get" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row" >
                        <select name="reini">
                            <option >Choisir un jour</option>
                            @foreach($global2 as $key)
                                <option value="{{$key->jour}}">{{$key->jour}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="edit" name="edit" value="">
                    <div class="col-md-6">
                        <button type="submit"  class="btn btn-success">Réinitialiser</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL SUPPRIMER -->
<div class="modal fade" id="supprimer_jour" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Supprimer un jour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('creneaux.supprimer') }}" method="get" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row" >
                        <select name="supprimer">
                            <option >Choisir un jour</option>
                            @foreach($global2 as $key)
                                <option value="{{$key->jour}}">{{$key->jour}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="edit" name="edit" value="">
                    <div class="col-md-6">
                        <button type="submit"  class="btn btn-success">Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL AJOUTER --> 
<div class="modal fade" id="ajouter_creneaux" style="z-index:200000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ajouter un créneau</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('creneaux.ajouter') }}" method="get" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row" >
                        <label for="staticEmail" class="col-sm-3 col-form-label">Choisissez un jour</label>
                        <select name="jour">
                            <option >Choisir un jour</option>
                            <option value="Lundi">Lundi</option>
                            <option value="Mardi">Mardi</option>
                            <option value="Mercredi">Mercredi</option>
                            <option value="Jeudi">Jeudi</option>
                            <option value="Vendredi">Vendredi</option>
                            <option value="Samedi">Samedi</option>
                            <option value="Dimanche">Dimanche</option>
                        </select>
                    </div>
                    <h3>Le matin</h3>
                    <div class="form-group row" >
                        <label for="staticEmail" class="col-sm-3 col-form-label">Choisissez une heure de début</label>
                        <div class="col-sm-5" style="margin-bottom: 1.5em">
                            <select name="deb_matin">
                                <option value="Fermé">Fermé</option>
                                <option value="11 H 00">11 H 00</option>
                                <option value="11 H 30">11 H 30</option>
                                <option value="12 H 00">12 H 00</option>
                                <option value="12 H 30">12 H 30</option>
                                <option value="13 H 00">13 H 00 </option>
                                <option value="13 H 30">13 H 30</option>
                                <option value="14 H 00">14 H 00</option>
                                <option value="14 H 30">14 H 30</option>
                                <option value="15 H 00">15 H 00</option>
                                <option value="15 H 30">15 H 30</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label for="staticEmail" class="col-sm-3 col-form-label">Choisissez une heure de fin</label>
                        <div class="col-sm-5" style="margin-bottom: 1.5em">
                            <select name="fin_matin">
                                <option value="Fermé">Fermé</option>
                                <option value="11 H 00">11 H 00</option>
                                <option value="11 H 30">11 H 30</option>
                                <option value="12 H 00">12 H 00</option>
                                <option value="12 H 30">12 H 30</option>
                                <option value="13 H 00">13 H 00 </option>
                                <option value="13 H 30">13 H 30</option>
                                <option value="14 H 00">14 H 00</option>
                                <option value="14 H 30">14 H 30</option>
                                <option value="15 H 00">15 H 00</option>
                                <option value="15 H 30">15 H 30</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label for="staticEmail" class="col-sm-3 col-form-label">Nombre de réservations possibles par créneau</label>
                        <div class="col-sm-5" style="margin-bottom: 1.5em">
                            <input type="number" value="1" name="livreur_matin" min="1">
                        </div>
                    </div>
                    <h3>Le soir</h3>
                    <div class="form-group row" >
                        <label for="staticEmail" class="col-sm-3 col-form-label">Choisissez une heure de début</label>
                        <div class="col-sm-5" style="margin-bottom: 1.5em">
                            <select name="deb_soir">
                                <option value="Fermé">Fermé</option>
                                <option value="17 H 00">17 H 00</option>
                                <option value="17 H 30">17 H 30</option>
                                <option value="18 H 00">18 H 00</option>
                                <option value="18 H 30">18 H 30</option>
                                <option value="19 H 00">19 H 00</option>
                                <option value="19 H 30">19 H 30</option>
                                <option value="20 H 00">20 H 00</option>
                                <option value="20 H 30">20 H 30</option>
                                <option value="21 H 00">21 H 00</option>
                                <option value="21 H 30">21 H 30</option>
                                <option value="22 H 00">22 H 00</option>
                                <option value="22 H 30">22 H 30</option>
                                <option value="23 H 00">23 H 00</option>
                                <option value="23 H 30">23 H 30</option>
                                <option value="24 H 00">00 H 00</option>
                                <option value="24 H 30">00 H 30</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label for="staticEmail" class="col-sm-3 col-form-label">Choisissez une heure de fin</label>
                        <div class="col-sm-5" style="margin-bottom: 1.5em">
                            <select name="fin_soir">
                                <option value="Fermé">Fermé</option>
                                <option value="17 H 00">17 H 00</option>
                                <option value="17 H 30">17 H 30</option>
                                <option value="18 H 00">18 H 00</option>
                                <option value="18 H 30">18 H 30</option>
                                <option value="19 H 00">19 H 00</option>
                                <option value="19 H 30">19 H 30</option>
                                <option value="20 H 00">20 H 00</option>
                                <option value="20 H 30">20 H 30</option>
                                <option value="21 H 00">21 H 00</option>
                                <option value="21 H 30">21 H 30</option>
                                <option value="22 H 00">22 H 00</option>
                                <option value="22 H 30">22 H 30</option>
                                <option value="23 H 00">23 H 00</option>
                                <option value="23 H 30">23 H 30</option>
                                <option value="24 H 00">00 H 00</option>
                                <option value="24 H 30">00 H 30</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" >
                        <label for="staticEmail" class="col-sm-3 col-form-label">Nombre de réservations possibles par créneau</label>
                        <div class="col-sm-5" style="margin-bottom: 1.5em">
                            <input type="number" value="1" name="livreur_soir" min="1">
                        </div>
                    </div>
                    <input type="hidden" id="edit" name="edit" value="">
                    <div class="col-md-6">
                        <button type="submit"  class="btn btn-success">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>