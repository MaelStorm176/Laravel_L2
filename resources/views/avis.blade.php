@extends('layouts.base')
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card mb-3 border-one">
                    <div class="card-header bg-one text-one">
                        <section class="row">
                            <div class="col">
                                <h5 class="mt-1">LES AVIS</h5>
                            </div>
                            @auth
                                <div class="col">
                                    <a href="{{route('commentaire')}}" class="btn btn-one float-right">Ajouter commentaire</a>
                                </div>
                            @endauth
                        </section>
                    </div>
                    <form class="w-100 bg-two" method="GET" action="{{route('avis')}}">
                        <select class="form-control rounded-0 bg-two text-two border-two" name="choix" onchange="this.form.submit();">
                            <option>Trier les commentaires</option>
                            <option value="recent">Les plus recent</option>
                            <option value="mieux">Les mieux notés</option>
                            <option value="moins">Les moins bien notés</option>
                        </select>
                    </form>
                    <div class="card-body pb-0">
                        <div class="list-group mb-3">
                            @foreach($commentaires as $key)
                                <div id="{{$key->id}}" class="list-group-item list-group-item-action list-group-item-primary p-0 mb-3 rounded border-secondary border">
                                    <div class="w-100 bg-white d-flex justify-content-between px-4 py-3 rounded-top">
                                        <h4 class="mb-0">{{$key->username}}</h4>
                                        @if($key->note <= 2)
                                            <span class="badge badge-danger px-3 py-2 rounded-circle">{{$key->note}}</span>
                                        @else
                                            @if($key->note == 3)
                                                <span class="badge badge-warning px-3 py-2 rounded-circle text-white">{{$key->note}}</span>
                                            @else
                                                <span class="badge badge-success px-3 py-2 rounded-circle">{{$key->note}}</span>
                                            @endif
                                        @endif
                                    </div>
                                    <div class="px-4 pt-2">
                                        <p class="mb-1 text-justify">{{$key->commentaire}}</p>
                                        <hr />
                                        <div class="w-100 text-center mb-2">
                                            <small>{{$key->created_at}}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <nav aria-label="Page navigation example">
                            {{ $commentaires->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
