@extends('layouts.base')
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">MES COMMANDES EN COURS</h5>
                </div>
                <table class="table table-hover table-bordered mb-3 text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">Numéro de Commande</th>
                            <th scope="col">Date</th>
                            <th scope="col">Heure</th>
                            <th scope="col">Prix Total</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">12345678</td>
                            <td class="align-middle">28/04</td>
                            <td class="align-middle">12h30</td>
                            <td class="align-middle">25€</td>
                            <td class="align-middle">En cours de préparation</td>
                            <td class="align-middle"><button type="button" class="btn btn-warning">Voir facture</button></td>
                        </tr>
                        <tr>
                            <td class="align-middle">12345679</td>
                            <td class="align-middle">28/04</td>
                            <td class="align-middle">12h30</td>
                            <td class="align-middle">25€</td>
                            <td class="align-middle">En cours de livraison</td>
                            <td class="align-middle"><button type="button" class="btn btn-warning">Voir facture</button></td>
                        </tr>
                    </tbody>
                </table>
                <div class="card bg-danger text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">MES COMMANDES TERMINEES</h5>
                </div>
                <table class="table table-hover table-bordered mb-3 text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">Numéro de Commande</th>
                            <th scope="col">Date</th>
                            <th scope="col">Heure</th>
                            <th scope="col">Prix Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">12345678</td>
                            <td class="align-middle">28/04</td>
                            <td class="align-middle">12h30</td>
                            <td class="align-middle">25€</td>
                            <td class="align-middle"><button type="button" class="btn btn-warning">Voir facture</button></td>
                        </tr>
                        <tr>
                            <td class="align-middle">12345679</td>
                            <td class="align-middle">28/04</td>
                            <td class="align-middle">12h30</td>
                            <td class="align-middle">25€</td>
                            <td class="align-middle"><button type="button" class="btn btn-warning">Voir facture</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection