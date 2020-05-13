@extends('layouts.adm')
@section('titre')
    STATISTIQUES<span class="fas fa-chart-pie mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Visiteurs<span class="fas fa-user-secret mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-bordered text-center mb-0">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre de Visiteurs</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="align-middle">Aujourd'hui</th>
                                    <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="align-middle">Cette semaine</th>
                                    <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="align-middle">Ce mois-ci</th>
                                    <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="align-middle">Cette année</th>
                                    <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="align-middle">Total</th>
                                    <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Comptes Utilisateurs<span class="fas fa-users float-right mt-1"></span></div>
                    <div class="card-body">
                        <table class="table table-bordered text-center mb-0">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre d'Inscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="align-middle">Aujourd'hui</th>
                                    <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="align-middle">Cette semaine</th>
                                    <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="align-middle">Ce mois-ci</th>
                                    <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="align-middle">Cette année</th>
                                    <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                </tr>
                                <tr>
                                    <th scope="row" class="align-middle">Total</th>
                                    <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Commandes <span class="fas fa-store float-right mt-1"></span></div>
                        <div class="card-body">
                            <table class="table table-bordered text-center mb-0">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre de Commandes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" class="align-middle">Aujourd'hui</th>
                                        <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="align-middle">Cette semaine</th>
                                        <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="align-middle">Ce mois-ci</th>
                                        <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="align-middle">Cette année</th>
                                        <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="align-middle">Total</th>
                                        <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card border-info mb-3">
                        <div class="card-header bg-info text-white">Avis<span class="fas fa-thumbs-up float-right mt-1"></span></div>
                        <div class="card-body">
                            <table class="table table-bordered text-center mb-0">
                                <thead class="bg-secondary text-white">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre d'Avis postés</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" class="align-middle">Aujourd'hui</th>
                                        <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="align-middle">Cette semaine</th>
                                        <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="align-middle">Ce mois-ci</th>
                                        <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="align-middle">Cette année</th>
                                        <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="align-middle">Total</th>
                                        <td><input type="text" class="form-control text-center" placeholder="xx" readonly></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection
