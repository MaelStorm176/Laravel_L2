@extends('layouts.base')
<!-- Material Design Bootstrap -->
<link href="/css/mdb.min.css" rel="stylesheet">
@section('content')
    <div class="content" id="content">
        <div>
        @auth
        @if(auth::user()->id_panier != NULL)
            <input type="hidden" value="{{$products}}" id="products">
            <div class="col-md-4 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Votre panier </span>

                    <span class="badge badge-secondary badge-pill" id="quantite_total">{{$quantite_total}} articles</span>
                </h4>
                <ul class="list-group mb-3 z-depth-1">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div style="width: 35%">
                            <h3 class="my-0">Articles</h3>
                        </div>
                        <div style="width: 35%">
                            <h3 class="my-0">Quantité</h3>
                        </div>
                        <div style="width: 30%">
                            <h3 class="my-0">Prix</h3>
                        </div>
                    </li>
                    @foreach($products as $key)
                        <li class="list-group-item d-flex justify-content-between lh-condensed" id="{{$key->id}}">
                            <div style="width: 40%">
                                <h6 class="my-0">{{$key->nom}}</h6>
                                <small class="text-muted"></small>
                            </div>
                            <div style="width: 30%">
                                <h6 class="my-0" ><input type="number" style="width: 30%" value="{{$key->quantite}}" onchange="refresh($(this).val(),{{$key->id}})"></h6>
                                <small class="text-muted"></small>
                            </div>
                            <span class="text-muted" style="width: 30%;">{{$key->promo}} € </span> <i id="supp_{{$key->id}}" onclick="supprimer({{$key->id}});" class="fas fa-times" style="cursor: pointer;"></i>

                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between lh-condensed" id="div_prix_total">
                        <div>
                            <h6 class="my-0">TOTAL</h6>
                            <small class="text-muted">TTC</small>
                        </div>
                        <span class="text-muted" style="width: 30%;"><strong id="prix_total"> {{$prix_total}} € </strong></span>
                    </li>
                </ul>
                @if($prix_total > 0)
                    <a href="{{route('payment')}}"><button class="btn btn-secondary btn-md waves-effect m-0">Valider et passer la commande</button></a>
                @endif
            </div>
        </div>
        @else
        @endif
        @endauth
        @guest
            <h1 class=" alert alert-danger"> Vous devez être connecté afin de bénéficier d'un panier </h1>
        @endguest
    </div>




    @include('toast')




@endsection
<script type="text/javascript">
    function refresh(value,id) {
        if(value <= 0){
            supprimer(id);
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
                },

                error: function (resultat, statut, erreur) {
                    alert('Erreur avec la requete Ajax');
                },
            });
        }
    }


    function supprimer(id){
        var dummy = Date.now();
        $.ajax({
            url :'panier.contenu_supprimer',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                var dataretour = code_html.split('_|');
                $('li[id="'+id+'"]').remove();
                $('#prix_total').html(dataretour[0]);
                $('#quantite_total').html(dataretour[1]+' articles');
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }

    $( "#target" ).click(function() {
        alert( "Handler for .click() called." );
    });
</script>
