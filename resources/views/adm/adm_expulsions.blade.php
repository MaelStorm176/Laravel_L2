@extends('layouts.adm')
@section('titre')
    EXPULSIONS<span class="fas fa-user-alt-slash mt-1 ml-1"></span>
@endsection
@section('contenu')
<div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Expulser un utilisateur<span class="fas fa-ban mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form>
                            <section class="row">
                                <div class="col-lg-4 mb-4">
                                    <label for="mail">Adresse Mail</label>
                                    <input type="mail" id="mail" class="form-control">
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="date">Date fin</label>
                                    <input type="date" id="date" class="form-control">
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="motif">Motif</label>
                                    <input type="text" id="motif" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-primary text-white w-100">EXCLURE</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Liste des explusions<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="align-middle" scope="col">MAIL</th>
                                    <th class="align-middle" scope="col">DATE DEBUT</th>
                                    <th class="align-middle" scope="col">DATE FIN</th>
                                    <th class="align-middle" scope="col">MOTIF</th>
                                    <th class="align-middle" scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">email0@exemple.fr</td>
                                    <td class="align-middle">10/05/2020</td>
                                    <td class="align-middle">10/06/2020</td>
                                    <td class="align-middle">Spam Avis(ex)</td>
                                    <td class="align-middle">
                                        <span class="fas fa-edit btn p-0"></span>
                                        <span class="fas fa-trash-alt btn p-0"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">email0@exemple.fr</td>
                                    <td class="align-middle">10/05/2020</td>
                                    <td class="align-middle">10/06/2020</td>
                                    <td class="align-middle">Spam Avis(ex)</td>
                                    <td class="align-middle">
                                        <span class="fas fa-edit btn p-0"></span>
                                        <span class="fas fa-trash-alt btn p-0"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle">email0@exemple.fr</td>
                                    <td class="align-middle">10/05/2020</td>
                                    <td class="align-middle">10/06/2020</td>
                                    <td class="align-middle">Spam Avis(ex)</td>
                                    <td class="align-middle">
                                        <span class="fas fa-edit btn p-0"></span>
                                        <span class="fas fa-trash-alt btn p-0"></span>
                                    </td>
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