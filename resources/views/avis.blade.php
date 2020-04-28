@extends('layouts.base')
@section('content')

    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">LES AVIS</h5>
                    <select>
                        <option>Les mieux notés</option>
                        <option>Les plus recent</option>
                        <option>Les moins bien notés</option>
                    </select>
                </div>
                <div class="list-group mb-3">
                    @foreach($commentaires as $key)
                    <a href="#" class="list-group-item list-group-item-action list-group-item-primary">
                        <div class="d-flex w-100 justify-content-between">
                            <h4 class="mb-1">NOM Prénom</h4>
                            <span class="badge badge-success p-2 rounded-circle shadow">5/5</span>
                        </div>
                        <p class="mb-1 text-justify">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                        <small>20/04/2020</small>
                    </a>
                    @endforeach
                </div>
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
        </section>
    </div>
@endsection
