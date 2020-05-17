@extends('layouts.base')
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card mb-3 border-success">
                    <div class="card-header bg-success text-white">
                        <section class="row">
                            <div class="col">
                                <h5 class="mt-1">LES AVIS</h5>
                            </div>
                            @auth
                                <div class="col">
                                    <a href="{{route('commentaire')}}" class="btn btn-primary float-right">Ajouter commentaire</a>
                                </div>
                            @endauth
                        </section>
                    </div>
                    <form class="w-100 bg-danger" method="GET" action="{{route('afficher')}}">
                        <select class="form-control rounded-0 bg-danger text-white border-danger" name="choix" onchange="this.form.submit();">
                            <option>Trier les commentaires</option>
                            <option value="recent">Les plus recent</option>
                            <option value="mieux">Les mieux notés</option>
                            <option value="moins">Les moins bien notés</option>
                        </select>
                    </form>
                    <div class="card-body">
                        <div class="list-group mb-3">
                            @foreach($commentaires as $key)
                                @if($key->note <= 2)
                                    <div class="list-group-item list-group-item-action list-group-item-primary p-0 mb-3 rounded border border-secondary">
                                        <div class="d-flex justify-content-between bg-danger text-white text-center w-100 py-3 px-5 rounded-top">
                                            <em><h4 class="mt-2">{{$key->username}}</h4></em>
                                            <div class="badge badge-secondary p-3 rounded-circle">
                                                @if($key->note == 1)
                                                    <span class="fas fa-star text-warning"></span>
                                                @else
                                                    <span class="fas fa-star mr-1 text-warning"></span>
                                                    <span class="fas fa-star text-warning"></span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="mb-1 text-justify py-4 px-5">{{$key->commentaire}}</p>
                                        <div class="bg-secondary text-white text-center w-100 p-2">
                                            <small>{{$key->created_at}}</small>
                                        </div>
                                    </div>
                                @else
                                    @if($key->note == 3)
                                        <div href="#" class="list-group-item list-group-item-action list-group-item-primary p-0 mb-3 rounded border border-secondary">
                                            <div class="d-flex justify-content-between bg-warning text-white text-center w-100 py-3 px-5 rounded-top">
                                                <em><h4 class="mt-2">{{$key->username}}</h4></em>
                                                <div class="badge badge-secondary p-3 rounded-circle">
                                                    <span class="fas fa-star mr-1 text-warning"></span>
                                                    <span class="fas fa-star mr-1 text-warning"></span>
                                                    <span class="fas fa-star text-warning"></span>
                                                </div>
                                            </div>
                                            <p class="mb-1 text-justify py-4 px-5">{{$key->commentaire}}</p>
                                            <div class="bg-secondary text-white text-center w-100 p-2">
                                                <small>{{$key->created_at}}</small>
                                            </div>
                                        </div>
                                    @else
                                        <div class="list-group-item list-group-item-action list-group-item-primary p-0 mb-3 rounded border border-secondary">
                                            <div class="d-flex justify-content-between bg-success text-white text-center w-100 py-3 px-5 rounded-top">
                                                <em><h4 class="mt-2">{{$key->username}}</h4></em>
                                                <div class="badge badge-secondary p-3 rounded-circle">
                                                    @if($key->note == 4)
                                                        <span class="fas fa-star mr-1 text-warning"></span>
                                                        <span class="fas fa-star mr-1 text-warning"></span>
                                                        <span class="fas fa-star mr-1 text-warning"></span>
                                                        <span class="fas fa-star text-warning"></span>
                                                    @else
                                                        <span class="fas fa-star mr-1 text-warning"></span>
                                                        <span class="fas fa-star mr-1 text-warning"></span>
                                                        <span class="fas fa-star mr-1 text-warning"></span>
                                                        <span class="fas fa-star mr-1 text-warning"></span>
                                                        <span class="fas fa-star text-warning"></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="mb-1 text-justify py-4 px-5">{{$key->commentaire}}</p>
                                            <div class="bg-secondary text-white text-center w-100 p-2">
                                                <small>{{$key->created_at}}</small>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <nav aria-label="Page navigation example mb-0">
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
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
