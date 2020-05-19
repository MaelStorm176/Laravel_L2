@extends('layouts.adm')
@section('titre')
    ENGAGEMENTS<span class="fas fa-object-group mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
            <div class="row row-cols-1 row-cols-md-3">
                @foreach($engagements as $key)
                    <div class="col mb-4">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="col-8">
                                    <img src="../img/engagements.jpg" class="card-img-top rounded-circle pt-3" alt="">
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$key->titre}}</h5>
                                <p class="card-text text-justify">{{$key->description_courte}}</p>
                            </div>
                            <div class="card-footer">
                                <section class="row">
                                    <form method="GET" action="{{route('supprimer_engagement')}}">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-danger" name="id" value="{{$key->id}}">Supprimer</button>
                                        </div>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div class="col mb-4">
                        <div class="card bg-info h-100 text-center text-white" type="button" data-toggle="modal" data-target="#ajoutModalCenterCode">
                            <div class="m-auto w-100 bg-secondary p-4">
                                <span class="fas fa-plus-circle "></span><br>
                                AJOUTER UN ELEMENT
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<!-- MODAL AJOUT ENGAGEMENT -->
<div class="modal fade" id="ajoutModalCenterCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLongTitleCode">Ajouter un engagement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0" method="GET" action="{{route('ajout_engagement')}}">
                <div class="modal-body">
                    <section class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="nom">Titre</label>
                            <input type="text" name="titre" class="form-control">
                        </div>
                    </section>
                    <section class="flex-column">
                        <div class="mb-3">
                            <label for="lien">Description courte</label>
                            <input type="text" name="description_courte" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="lien">Description longue</label>
                            <input type="text" name="description_longue" class="form-control">
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
