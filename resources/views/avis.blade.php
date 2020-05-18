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
                </div>
                @auth
                    <a href="commentaire" class="btn btn-outline-primary">Ajouter commentaire</a>
                @endauth
                <div class="list-group mb-3">
                    @foreach($commentaires as $key)
                        <a href="#" class="list-group-item list-group-item-action list-group-item-primary">
                            <div class="d-flex w-100 justify-content-between">
                                <h4 class="mb-1">{{$key->username}}</h4>
                                <span class="badge badge-success p-2 rounded-circle shadow">{{$key->note}}</span>
                            </div>
                            <p class="mb-1 text-justify">{{$key->commentaire}}</p>
                            <small>{{$key->created_at}}</small>
                        </a>
                    @endforeach
                </div>
                <nav aria-label="Page navigation example">
                    {{$commentaires->links()}}
                </nav>
            </div>
        </section>
    </div>
@endsection
