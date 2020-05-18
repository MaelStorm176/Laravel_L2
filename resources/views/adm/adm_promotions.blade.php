@extends('layouts.adm')
@section('titre')
    PROMOTIONS<span class="fas fa-percent mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Ajouter ou modifier une promotion<span class="fas fa-plus-circle mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form action="{{route('promotion')}}" method="post">
                            @csrf
                            <section class="row">
                                <div class="col-lg-4 mb-4">
                                    <label for="categorie">Categorie</label>
                                    <select class="form-control" id="categorie" onchange="refresh_article(value)">
                                        <option name="categorie">-- Selectionner --</option>
                                        @foreach($categories as $categorie)
                                            <option value="{{$categorie->nom}}">{{$categorie->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="article">Article</label>
                                    <select class="form-control" name="id" id="article">
                                        <option name="pizza">-- Selectionner --</option>
                                        @foreach($pizza as $key)
                                            <option value="{{$key->id}}">{{$key->nom}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="remise">Remise en %</label>
                                    <input type="number" name="promotion" id="promotion" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary text-white w-100">AJOUTER</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Promotions actives<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-0 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="align-middle" scope="col">CATEGORIE</th>
                                    <th class="align-middle" scope="col">ARTICLE</th>
                                    <th class="align-middle" scope="col">REMISE</th>
                                    <th class="align-middle" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($pizza as $key)
                                @if($key->promo < $key->prix)
                                    <tr>
                                        <td class="align-middle">{{$key->categorie}}</td>
                                        <td class="align-middle">{{$key->nom}}</td>
                                        <td class="align-middle">{{100 - ($key->promo / $key->prix ) * 100}} %</td>
                                        <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


<script>
    function refresh_article(nom) {
        var dummy = Date.now();
        $.ajax({
            url :'promotions/refresh_article',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, nom:nom},
            success : function(code_html, statut){
                $('#article').html(code_html);
            },
            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }

</script>
