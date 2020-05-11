@extends('layouts.adm')
@section('titre')
    PROMOTIONS<span class="fas fa-percent mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Ajouter une promotion<span class="fas fa-plus-circle mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form>
                            <section class="row">
                                <div class="col-lg-4 mb-4">
                                    <label for="categorie">Categorie</label>
                                    <select class="form-control" id="categorie">
                                        <option value="">-- Selectionner --</option>
                                        <option value="Categorie1">Categorie1</option>
                                        <option value="Categorie2">Categorie2</option>
                                        <option value="CategorieN">CategorieN</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="article">Article</label>
                                    <select class="form-control" id="article">
                                        <option value="">-- Selectionner --</option>
                                        <option value="Article1">Article1</option>
                                        <option value="Article2">Article2</option>
                                        <option value="ArticleN">ArticleN</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="remise">Remise en %</label>
                                    <input type="number" id="remise" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary text-white w-100">AJOUTER</button>
                                </div>
                            </section>            
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Promotions actives<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-0 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="align-middle" scope="col">CATEGORIE</th>
                                    <th class="align-middle" scope="col">ARTICLE</th>
                                    <th class="align-middle" scope="col">REMISE</th>
                                    <th class="align-middle" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">Pizzas</td>
                                    <td class="align-middle">Pizza1</td>
                                    <td class="align-middle">10%</td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Pizzas</td>
                                    <td class="align-middle">Pizza1</td>
                                    <td class="align-middle">10%</td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Pizzas</td>
                                    <td class="align-middle">Pizza1</td>
                                    <td class="align-middle">10%</td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection