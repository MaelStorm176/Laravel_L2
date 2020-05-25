@extends('layouts.base')
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-one mb-3">
                    <div class="card-header bg-one text-one">
                        <div class="container">
                            <section class="row justify-content-between">
                                <h5 class="mt-1">MON PANIER</h5>
                                <h5 class="mt-1 mb-0">
                                    <span class="badge badge-secondary badge-pill px-2 py-1" id="quantite_total">{{$quantite_total ?? 0}} articles</span>
                                </h5>
                            </section>
                        </div>
                    </div>
                    <div class="card-body">
                        @auth
                            @if(!Empty($products) || !Empty($menu))
                                <input type="hidden" value="{{$products}}" id="products">
                                <table class="table table-hover table-bordered mb-0 text-center">
                                    <thead class="bg-tab text-tab">
                                        <tr>
                                            <th scope="col">Article</th>
                                            <th scope="col">Quantité</th>
                                            <th scope="col">Prix</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $key)
                                            <tr id="article_{{$key->id}}">
                                                <td class="align-middle">{{ $key->nom }}</td>
                                                <td class="align-middle">
                                                    <input type="number" class="text-center form-control" value="{{$key->quantite}}" onchange="refresh($(this).val(),{{$key->id}},1)">
                                                </td>
                                                <td class="align-middle">{{ $key->promo }} €</td>
                                                <td class="align-middle">
                                                    <span id="supp_{{$key->id}}" onclick="supprimer({{$key->id}},1);" class="fas fa-times" style="cursor: pointer;"></span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach($menu as $key2)
                                            <tr id="menu_{{$key2->id}}">
                                                <td class="align-middle">{{ $key2->nom }}</td>
                                                <td class="align-middle">
                                                    <input type="number" class="text-center" value="{{$key2->quantite}}" onchange="refresh($(this).val(),{{$key2->id}},0)">
                                                </td>
                                                <td class="align-middle">{{ $key2->promo }} €</td>
                                                <td class="align-middle">
                                                    <span id="supp_menu{{$key2->id}}" onclick="supprimer({{$key2->id}},0);" class="fas fa-times" style="cursor: pointer;"></span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="bg-two text-two align-middle">TOTAL TTC
                                                <br/>
                                                <i id="attention" class="fas fa-exclamation-triangle"></i>
                                                <em><small>(Votre commande ne doit pas dépasser 255 €)</small></em>
                                            </td>
                                            <td colspan="2" class="bg-two text-two align-middle">
                                                <strong><span id="prix_total">{{$prix_total}} €</span></strong><br/>
                                            </td>
                                            <td class="bg-two text-two">
                                                @if($prix_total > 0)
                                                    <a href="{{route('payment')}}" class="btn btn-one">Commander</a>
                                                @else
                                                    <a href="{{route('pizza_all')}}" class="btn btn-one">Ajouter des articles</a>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        @endauth
                        @guest
                            <h1 class="alert alert-danger"> Vous devez être connecté afin de bénéficier d'un panier </h1>
                        @endguest
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<script type="text/javascript">
    function refresh(value,id,type) {
        if(value <= 0){
            supprimer(id,type);
        }
        else {

            var dummy = Date.now();
            $.ajax({
                url: 'panier.modifier',
                type: 'GET',
                dataType: 'html',
                data: {dummy: dummy, id: id, value: value},
                success: function (code_html, statut) {
                    //$('div[id="'+id+'"]').remove();
                    var dataretour = code_html.split('_|');
                    $('#prix_total').html(dataretour[0]);
                    $('#quantite_total').html(dataretour[1]+' articles');
                    $('#quantite_total_panier').html(dataretour[1]);
                },

                error: function (resultat, statut, erreur) {
                    alert('Erreur avec la requete Ajax');
                },
            });
        }
    }


    function supprimer(id,type){
        var dummy = Date.now();
        $.ajax({
            url :'panier.contenu_supprimer',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                var dataretour = code_html.split('_|');
                if(type === 1){
                    $('tr[id="article_'+id+'"]').remove();
                }
                if(type === 0){
                    $('tr[id="menu_'+id+'"]').remove();
                }
                $('#prix_total').html(dataretour[0]);
                $('#quantite_total').html(dataretour[1]+' articles');
                $('#quantite_total_panier').html('0');
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }
</script>
