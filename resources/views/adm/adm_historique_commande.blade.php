@extends('layouts.adm')
@section('titre')
    HISTORIQUE DES COMMANDES TERMINEES<span class="fas fa-hourglass-end mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Commandes Terminées<span class="fas fa-box-open mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Détail de la commande</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Statut Paiement</th>
                                    <th scope="col">Heure de la commande</th>
                                    <th scope="col">Heure de la fin de préparation</th>
                                    <th scope="col">Statut Préparation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->num_commande }}</td>
                                        <td>{{ Auth::user()->email }}</td>
                                        <td>{{ $value->prix_total }}</td>
                                        <td>{{ $value->statut_pay }}</td>
                                        <td>{{ $value->created_at }}</td>
                                        <td>{{ $value->updated_at }}</td>
                                        <td>{{ $value->statut_prepa }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if(Auth::user()->role=='admin')
                            {!! $products->render() !!}
                        @endif
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
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