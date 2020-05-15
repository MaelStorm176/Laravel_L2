@extends('layouts.adm')
@section('titre')
    MENUS<span class="fas fa-list-alt mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Creer un menu<span class="fas fa-plus-circle mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form>
                            <section class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="nom">Nom</label>
                                    <input type="text" id="nom" class="form-control">
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="prix">Prix (€)</label>
                                    <input type="number" id="prix" class="form-control">
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="categorie">Catégorie</label>
                                    <select class="form-control" id="categorie">
                                        <option value="">-- Selectionner --</option>
                                        <option value="Categorie1">Categorie1</option>
                                        <option value="Categorie2">Categorie2</option>
                                        <option value="CategorieN">CategorieN</option>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="quantite">Quantité</label>
                                    <input type="number" class="form-control" id="quantite">
                                </div>
                                <div class="col-lg-6">
                                    <buttton type="button" class="btn btn-secondary w-100 align-bottom">AJOUTER UN ITEM</button>
                                </div>
                                <div class="col-lg-6">
                                    <button type="submit" class="btn btn-primary w-100">CREER</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Liste des menus<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <section class="row row-cols-1 row-cols-md-2">
                            @foreach($menus as $menu)
                                <div class="col mb-3">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-md-4">
                                                <img src="../img/menus.jpg" class="rounded-left w-100 h-100">
                                             </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <div class="badge badge-primary p-2 float-right text-white"> {{$menu->promo}} €</div>
                                                    <h5 class="card-title mt-1">{{$menu->nom}}</h5>
                                                    <p class="card-text text-justify">{{$menu->description}}</p>
                                                    <ul class="list-group mb-3">
                                                        @foreach($contenu_menu as $key)
                                                            @if($key->id_menu == $menu->id)
                                                                @foreach($pizza as $item)
                                                                    @if($item->id == $key->id_pizza)
                                                                        <li class="list-group-item list-group-item-primary rounded-0">
                                                                            {{$item->nom}}
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    <section class="row">
                                                        <div class="col-lg-6">
                                                            <button type="button" class="btn btn-success w-100">MODIFIER</button>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <button type="button" class="btn btn-danger w-100">SUPPRIMER</button>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                        </section>
                    </div>
                </div>
            </div>
@endsection
