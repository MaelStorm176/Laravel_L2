@extends('layouts.base')
@section('content')

    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">LES AVIS</h5>
                    <form method="GET" action={{route('afficher')}}>
                        <select name="choix" onchange="this.form.submit();">
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
                    <ul class="pagination justify-content-center">
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
        </section>
    </div>
@endsection
