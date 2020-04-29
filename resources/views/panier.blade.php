@extends('layouts.base')
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <div class="container">
                        <section class="row">
                            <h5 class="col-4 offset-4 mb-0">MON PANIER</h5>
                            <h5 class="col-1 offset-3 mb-0">
                                <span class="badge badge-secondary badge-pill px-2 py-1" id="quantite_total">{{$quantite_total}} articles</span>
                            </h5>
                        </section>
                    </div>
                </div>
                @auth
                    @if(auth::user()->id_panier != NULL)
                        <input type="hidden" value="{{$products}}" id="products">        
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Article</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $key)
                                    <tr id="{{$key->id}}">
                                        <td class="align-middle">{{ $key->nom }}</td>
                                        <td class="align-middle">
                                            <input type="number" class="text-center" value="{{$key->quantite}}" onchange="refresh($(this).val(),{{$key->id}})">
                                        </td>
                                        <td class="align-middle">{{ $key->promo }} €</td>
                                        <td class="align-middle">
                                            <span id="supp_{{$key->id}}" onclick="supprimer({{$key->id}});" class="fas fa-times" style="cursor: pointer;"></span>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td class="bg-secondary text-white align-middle">TOTAL TTC</td>
                                    <td colspan="2" class="bg-secondary text-white align-middle"><span id="prix_total">{{$prix_total}} €</span></td>
                                    <td class="bg-secondary text-white">
                                        @if($prix_total > 0)
                                            <a href="{{route('payment')}}" class="btn btn-warning">Commander</a>
                                        @else
                                            <a href="{{route('pizza_all')}}" class="btn btn-warning">Ajouter des articles</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                @endauth
                @guest
                    <h1 class=" alert alert-danger"> Vous devez être connecté afin de bénéficier d'un panier </h1>
                @endguest
            </div>
        </section>
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
                $('tr[id="'+id+'"]').remove();
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
