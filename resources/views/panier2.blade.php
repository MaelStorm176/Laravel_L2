@extends('layouts.base')
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">MON PANIER</h5>
                </div>
                <table class="table table-hover table-bordered mb-3 text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">Article</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">Pizza1</td>
                            <td class="align-middle">3</td>
                            <td class="align-middle">24€</td>
                            <td class="align-middle"><button type="button" class="btn btn-info text-white mr-1">Voir détails</button><button type="button" class="btn btn-danger">Supprimer</button></td>
                        </tr>
                        <tr>
                            <td class="align-middle">Pizza4</td>
                            <td class="align-middle">2</td>
                            <td class="align-middle">18€</td>
                            <td class="align-middle"><button type="button" class="btn btn-info text-white mr-1">Voir détails</button><button type="button" class="btn btn-danger">Supprimer</button></td>
                        </tr>
                        <tr>
                            <td class="bg-secondary text-white align-middle">TOTAL</td>
                            <td colspan="2" class="bg-secondary text-white align-middle">42€</td>
                            <td class="bg-secondary text-white"><button type="button" class="btn btn-warning">Commander</button></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection