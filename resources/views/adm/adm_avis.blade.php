@extends('layouts.adm')
@section('titre')
    AVIS<span class="fas fa-comment mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="list-group mb-3 border-0">
                    <a href="#" class="list-group-item list-group-item-action list-group-item-primary p-0 mb-3 rounded border border-secondary">
                        <div class="d-flex justify-content-between bg-success text-white text-center w-100 py-3 px-5 rounded-top">
                            <em><h4 class="mt-2">NOM Prénom</h4></em>
                            <div class="badge badge-secondary p-3 rounded-circle">
                                <span class="fas fa-star mr-1 text-warning"></span>
                                <span class="fas fa-star mr-1 text-warning"></span>
                                <span class="fas fa-star mr-1 text-warning"></span>
                                <span class="fas fa-star mr-1 text-warning"></span>
                                <span class="fas fa-star text-warning"></span>
                            </div>
                        </div>
                        <p class="mb-1 text-justify py-4 px-5">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                        <div class="bg-secondary text-white text-center w-100 p-2">
                            <small>Posté le 20/04/2020 à 16h15</small>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action list-group-item-primary p-0 mb-3 rounded border border-secondary">
                        <div class="d-flex justify-content-between bg-warning text-white text-center w-100 py-3 px-5 rounded-top">
                            <em><h4 class="mt-2">NOM Prénom</h4></em>
                            <div class="badge badge-secondary p-3 rounded-circle">
                                <span class="fas fa-star mr-1 text-warning"></span>
                                <span class="fas fa-star mr-1 text-warning"></span>
                                <span class="fas fa-star text-warning"></span>
                            </div>
                        </div>
                        <p class="mb-1 text-justify p-4">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                        <div class="bg-secondary text-white text-center w-100 p-2">
                            <small>Posté le 20/04/2020 à 16h15</small>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action list-group-item-primary p-0 mb-3 rounded border border-secondary">
                        <div class="d-flex justify-content-between bg-danger text-white text-center w-100 py-3 px-5 rounded-top">
                            <em><h4 class="mt-2">NOM Prénom</h4></em>
                            <div class="badge badge-secondary p-3 rounded-circle">
                                <span class="fas fa-star text-warning"></span>
                            </div>
                        </div>
                        <p class="mb-1 text-justify p-4">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                        <div class="bg-secondary text-white text-center w-100 p-2">
                            <small>Posté le 20/04/2020 à 16h15</small>
                        </div>
                    </a>
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