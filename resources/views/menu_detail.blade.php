@extends('layouts.base')

@section('ban')../../@endsection
@section('logo')../../@endsection
@section('favi')../../@endsection

@section('content')
    @foreach($menu as $key)
    @endforeach
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-one mb-3">
                    <div class="card-header bg-one text-one">
                        <h2 class="text-center align-bottom mb-0">{{$key->nom}}</h2>
                    </div>
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="../../images/menu.jpg" class="w-100" style="border-radius: 0 0 0 0.25rem;" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                @if($key->promo < $key->prix && $key->promo > 0)
                                    <div class="badge badge-danger p-2 float-right text-white">
                                        <span class="mr-1">
                                            <del>{{$key->prix}} €</del>
                                        </span>
                                        {{$key->promo}} €
                                    </div>
                                @else
                                    <div class="badge badge-primary p-2 float-right text-white">{{$key->prix}} €</div>
                                @endif
                                @auth
                                    @if(Auth::user()->role=='admin')
                                        <a onclick="afficher_promo()">
                                            <span class="badge badge-danger mb-3 ">Appliquer une promotion</span>
                                        </a>
                                        <div class="input-group mb-3" id="div-promotion" style="display: none;">
                                            <form action="{{route('menu.promotion')}}" method="post">
                                                @csrf
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                    <input type="hidden" value="{{$key->id}}" name="id">
                                                    <input type="number" class="form-control" id="input-promotion" name="promotion" placeholder="Promotion">
                                                    <button class="btn btn-outline-one" type="submit">Valider</button>
                                                </div>

                                            </form>
                                        </div>
                                    @endif
                                @endauth
                                <h4 class="mb-3"><u>Description:</u></h4>
                                <p class="card-text text-justify mb-3">{{$key->description}}</p>
                                <div class="row justify-content-center">
                                    <div class="col-6">
                                        @auth
                                            <form class="justify-content-left" action="{{route('panier.ajouter_menu')}}">
                                                <input type="hidden" value="{{$key->id}}" name="id_menu">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="quantite" value="1" aria-label="Search">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-one" type="submit">
                                                            Ajouter à votre panier
                                                            <span class="fas fa-shopping-cart ml-1"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        @endauth
                                        @guest
                                                <button class="btn btn-one" data-toggle="modal" data-target="#connexionModal">Pour commander, connectez vous !</button>
                                        @endguest
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12" >
                <div class="card bg-two text-two text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">Contenu du {{$key->nom}}</h5>
                    <i onclick="afficher_nutri()" class="fas fa-angle-down float-right" style="cursor: pointer"></i>
                </div>
                <table id="table_menu" class="table table-bordered" style="display: none;">
                    <thead class="bg-nav text-nav">
                        <tr>
                            <th class="text-center" scope="col">Articles</th>
                            <th class="text-center" scope="col">Catégories</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pizza as $piz)
                        <tr>
                            <td><input type="text" class="form-control text-center" id="sodium" name="sodium" placeholder="{{$piz->nom}}" readonly></td>
                            <td><input type="text" class="form-control text-center" id="fibres" name="fibres" placeholder="{{$piz->categorie}}"readonly></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    function afficher_promo() {
        $('#div-promotion').show();
    }

    function afficher_nutri() {
        var display =  $("#table_menu").css("display");
        if(display!="none")
        {
            $("#table_menu").attr("style", "display:none");
        }
        else
        {
            $('#table_menu').show();
            $('#table_menu').effect("slide","slow");
        }
    }
</script>
