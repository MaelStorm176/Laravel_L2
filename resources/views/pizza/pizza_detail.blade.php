@extends('layouts.base')

@section('ban')../@endsection
@section('logo')../@endsection
@section('favi')../@endsection

@section('content')
    @foreach($pizza as $key)
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
                            <img src="../{{$key->photo}}" class="w-100" style="border-radius: 0 0 0 0.25rem;" alt="...">
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
                                            <form action="{{route('promotion')}}" method="post">
                                                @csrf
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">%</span>
                                                    <input type="hidden" value="{{$key->id}}" name="id">
                                                    <input type="number" class="form-control" id="input-promotion" name="promotion" placeholder="Promotion">
                                                    <button class="btn btn-outline-success" type="submit">Valider</button>
                                                </div>

                                            </form>
                                        </div>
                                    @endif
                                @endauth
                                <h4 class="mb-3"><u>Description:</u></h4>
                                <p class="card-text text-justify mb-3">{{$key->description_longue}}</p>
                                <div class="row justify-content-center">
                                    <div class="col-6">
                                        @auth
                                            <form class="justify-content-left" action="{{route('panier.ajouter')}}">
                                                <input type="hidden" value="{{$key->id}}" name="id_pizza">
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
                    <h5 class="mb-0">Valeurs Nutritionnelles</h5>
                    <i onclick="afficher_nutri({{$key->nutrition}},'{{$key->nom}}')" class="fas fa-angle-down float-right" style="cursor: pointer"></i>
                </div>
                <table id="table_nutrition" class="table table-bordered" style="display: none;">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">Sodium (mg)</th>
                            <th scope="col">Fibres (g)</th>
                            <th scope="col">Dont_satures (g)</th>
                            <th scope="col">Lipides (g)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control text-center" id="sodium" name="sodium" placeholder="xx" readonly></td>
                            <td><input type="text" class="form-control text-center" id="fibres" name="fibres" placeholder="xx"readonly></td>
                            <td><input type="text" class="form-control text-center" id="dont_satures" name="dont_satures" placeholder="xx" readonly></td>
                            <td><input type="text" class="form-control text-center" id="lipides" name="lipides" placeholder="xx" readonly></td>
                        </tr>
                    </tbody>
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">Dont_sucres (g)</th>
                            <th scope="col">Glucides (g)</th>
                            <th scope="col">Proteines (g)</th>
                            <th scope="col">Energies (kcal)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control text-center" id="dont_sucres" name="dont_sucres" placeholder="xx" readonly></td>
                            <td><input type="text" class="form-control text-center" id="glucides" name="glucides" placeholder="xx" readonly></td>
                            <td><input type="text" class="form-control text-center" id="proteines" name="proteines" placeholder="xx" readonly></td>
                            <td><input type="text" class="form-control text-center" id="energies" name="energies" placeholder="xx" readonly></td>
                        </tr>
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
    function afficher_nutri(id,nom) {
        var display =  $("#table_nutrition").css("display");
        if(display!="none")
        {
            $("#table_nutrition").attr("style", "display:none");
        }
        else
        {
            remplissage_tab(id,nom);
            $('#table_nutrition').show();
            $('#table_nutrition').effect("slide","slow");
        }
    }

    function remplissage_tab(id,nom)
    {
        var dummy = Date.now();
        $.ajax({
            url :nom+'/remplissage_tab',
            type : 'get',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                var dataretour = code_html.split('_|');
                $('#sodium').val(dataretour[0]);
                $('#fibres').val(dataretour[1]);
                $('#dont_satures').val(dataretour[2]);
                $('#lipides').val(dataretour[3]);
                $('#dont_sucres').val(dataretour[4]);
                $('#glucides').val(dataretour[5]);
                $('#proteines').val(dataretour[6]);
                $('#energies').val(dataretour[7]);
            },
            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }
</script>
