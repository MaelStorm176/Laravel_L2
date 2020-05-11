@extends('layouts.adm')
@section('titre')
    INFORMATIONS<span class="fas fa-info-circle mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Rechercher un Utilisateur<span class="fas fa-search mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form>
                            <section class="row">
                                <div class="col-lg-4 mb-4">
                                    <label for="nom">Nom</label>
                                    <input type="text" id="nom" class="form-control">
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" id="prenom" class="form-control">
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="mail">Adresse Mail</label>
                                    <input type="text" id="mail" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-primary text-white w-100">RECHERCHER</button>
                                </div>
                            </section>            
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Liste des Utilisateurs<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="align-middle" scope="col">NOM</th>
                                    <th class="align-middle" scope="col">PRENOM</th>
                                    <th class="align-middle" scope="col">MAIL</th>
                                    <th class="align-middle" scope="col">ADRESSE IP</th>
                                    <th class="align-middle" scope="col">POINTS FIDELITE</th>
                                    <th class="align-middle" scope="col">NOMBRES COMMANDES</th>
                                    <th class="align-middle" scope="col">ARGENT VERSEE</th>
                                    <th class="align-middle" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">DUPONT</td>
                                    <td class="align-middle">Jean</td>
                                    <td class="align-middle">email0@exemple.fr</td>
                                    <td class="align-middle">XXX.XXX.XXX.XXX</td>
                                    <td class="align-middle">24</td>
                                    <td class="align-middle">65</td>
                                    <td class="align-middle">800€</td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">DUPONT</td>
                                    <td class="align-middle">Jean</td>
                                    <td class="align-middle">email0@exemple.fr</td>
                                    <td class="align-middle">XXX.XXX.XXX.XXX</td>
                                    <td class="align-middle">24</td>
                                    <td class="align-middle">65</td>
                                    <td class="align-middle">800€</td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">DUPONT</td>
                                    <td class="align-middle">Jean</td>
                                    <td class="align-middle">email0@exemple.fr</td>
                                    <td class="align-middle">XXX.XXX.XXX.XXX</td>
                                    <td class="align-middle">24</td>
                                    <td class="align-middle">65</td>
                                    <td class="align-middle">800€</td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédant</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Suivant</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection