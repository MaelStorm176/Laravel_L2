@extends('layouts.base')
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-9">
                <form role="form" action="{{ route('stripe.post') }}" method="post" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                    @csrf
                    <?php
                        $user =Auth::user()->id;
                        $email =Auth::user()->email;
                    ?>
                    <input value="<?php echo $email;?>" name="user_email" type="hidden">
                    <input value="<?php echo $user;?>" name="user_id" type="hidden">
                    <input value="{{$prix_total}}" name="prix_total" id="prix_total" type="hidden">
                    <input value="{{$prix=$prix_total}}" name="prix" id="prix" type="hidden">
                    <input value="{{$products}}" name="products" type="hidden">
                    <input value="com_{{auth::user()->id}}_{{$prix_total}}" name="num_commande" type="hidden">
                    <div class="card border-one mb-3">
                        <div class="card-header bg-one text-one">Identité et Lieu de livraison<span class="fas fa-map-pin float-right mt-1"></span></div>
                        <div class="card-body">
                            <section class="row">
                                <!-- NOM DESTINATAIRE -->
                                <div class="col-lg-6 mb-3">
                                    <input type="text" id="firstName" class="form-control" placeholder="Prénom" value="{{auth::user()->first_name}}" maxlength="25" required>
                                </div>
                                <!-- PRENOM DESTINATAIRE -->
                                <div class="col-lg-6 mb-3">
                                    <input type="text" id="lastName" class="form-control" placeholder="Nom de famille" value="{{auth::user()->last_name}}" maxlength="25" required>
                                </div>
                                <!-- ADRESSE DE LIVRAISON -->
                                <div class="col-lg-12">
                                    <input type="text" id="address" placeholder="Adresse" name="address" class="form-control" maxlength="50" required>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="card border-one mb-3">
                        <div class="card-header bg-one text-one">Paiement<span class="fas fa-hand-holding-usd float-right mt-1"></span></div>
                        <div class="card-body">
                            <section class="row justify-content-center">
                                <div class="col pr-0">
                                    <div class="form-check form-check-inline float-right">
                                        <label class="form-check-label mr-1" for="credit">Carte de crédit</label>
                                        <input class="form-check-input" type="radio" id="credit" name="paymentMethod" checked required>
                                    </div>
                                </div>
                                <div class="col pl-0">
                                    <div class="form-check form-check-inline float-left">
                                        <input class="form-check-input" type="radio" id="paypal" name="paymentMethod" required>
                                        <label class="form-check-label" for="paypal">Paypal</label>
                                    </div>
                                </div>
                            </section>
                            <section class="row">
                                <!-- NUMERO CARTE DE CREDIT -->
                                <div class="col-lg-8 mb-3">
                                    <label for="cc-number">N° Carte de crédit</label>
                                    <input type="text" class="form-control" id="cc-number" name="card_number" placeholder="Ex : 5678 2345 7418 5693" maxlength="16" required>
                                </div>
                                <!-- DATE EXPIRATION -->
                                <div class="col-lg-4 mb-3">
                                    <label for="cc-expiration">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" name="card_mm_yyyy" placeholder="MM/YYYY" maxlength="7" required>
                                </div>
                                <!-- NOM SUR LA CARTE -->
                                <div class="col-lg-8 mb-3">
                                    <label for="cc-name">Nom sur votre carte</label>
                                    <input type="text" class="form-control" id="cc-name" name="card_name" placeholder="Ex : JEAN DUPONT" maxlength="50" required>
                                    <small class="text-muted">Veuillez écrire le nom présent sur votre carte en majuscule</small>
                                </div>
                                <!-- CVV -->
                                <div class="col-lg-4 mb-3">
                                    <label for="cc-expiration">CVV</label>
                                    <input type="number" class="form-control" id="card_cvc" name="card_cvc" placeholder="Ex : 123" min="0" max="999" maxlength="3" required>
                                </div>
                                <!-- BOUTTON VALIDER -->
                                <div class="col-lg-12">
                                    <button class="btn btn-primary w-100" type="submit">Valider le paiement</button>
                                </div>
                            </section>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3">
                <div class="card border-two mb-3">
                    <div class="card-header bg-two text-two">Votre Panier<span class="badge badge-secondary badge-pill float-right mt-1">{{$q_tot}} articles</span></div>
                    <div class="card-body">
                        <ul class="list-group mb-0 z-depth-1">
                            @foreach($products as $key)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{$key->nom}} x {{$key->quantite}}</h6>
                                        <small class="text-muted">{{$key->statut}}</small>
                                    </div>
                                    <span class="text-muted">{{$key->promo}} €</span>
                                </li>
                            @endforeach
                            @foreach($menu as $key2)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">{{$key2->nom}} x {{$key2->quantite}}</h6>
                                        <small class="text-muted">{{$key->statut}}</small>
                                    </div>
                                    <span class="text-muted">{{$key2->promo}} €</span>
                                </li>
                            @endforeach
                            <li id="affichage" style="display:none;" class="list-group-item justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">Promo code</h6>
                                    <small id="affcode"></small>
                                </div>
                                <span class="text-success" id="remise"></span>
                            </li>
                            <li id="affichage2" style="display:none;" class="list-group-item justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">Points fidelités</h6>
                                    <small id="affpoints"></small>
                                </div>
                                <span class="text-success" id="remise2"></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">TOTAL</h6>
                                    <small class="text-muted">TTC</small>
                                </div>
                                <span id="total" class="text-muted"><strong> {{$prix_total}} € </strong></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card border-two mb-3">
                    <div class="card-header bg-two text-two">Code Promo<span class="fas fa-gift float-right mt-1"></span></div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="text" name="code" id="code" class="form-control" placeholder="Code promo" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary btn-md waves-effect m-0" onclick="testvalidite()">UTILISER</button>
                            </div>
                        </div>
                        <span class="text-danger" style="display:none;" id="invalide">Code invalide</span>
                        <span class="text-success" style="display:none;" id="valide">Code valide</span>
                    </div>
                </div>
                <div class="card border-two mb-3">
                    <div class="card-header bg-two text-two">Points de Fidélité<span class="fas fa-gift float-right mt-1"></span></div>
                    <div class="card-body">
                        <section class="row">
                            @foreach($parametres as $key)
                                <input id="equivalent" type="hidden" value="{{$key->ptsEquivalent}}">
                            @endforeach
                            <div class="col-lg-12">                
                                <label for="pointsTotal">Mes points</label>
                                <input type="text" id="pointsTotal" name="pointsTotal" value="{{Auth::user()->pointsFidelite}}" class="from-control text-center bg-secondary mb-3 w-100 rounded text-white border-0" readonly>            
                            </div>
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <input type="number" id="points" name="points" class="form-control" placeholder="Nombre points" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary btn-md waves-effect m-0"  onclick="utiliserPoints()">UTILISER</button>
                                    </div>
                                </div>
                            </div>
                            <span class="text-danger" style="display:none;" id="invalide2">Il y a une erreur avec le nombre de points.</span>
                            <span class="text-success" style="display:none;" id="valide2">Les points on été utilisés.</span>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<!-- JQUERY -->
<script
    src="https://code.jquery.com/jquery-3.5.0.min.js"
    integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.0.1/jquery.payment.min.js"></script>


<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">

    function testvalidite() {
        const code = $("#code").val();
        var prix = $("#prix").val();

        $.ajax({
            url : 'testvalidite',
            type : 'GET',
            dataType : 'html',
            data : {code:code},
            success : function(code_html, statut){
                var res = code_html.split('/');
                var remise;
                if(res[0] == 1) {
                    $("#valide").show();
                    $("#invalide").hide();
                    $("#affichage").css("display","flex");
                    $("#affichage").show();
                    prix*=res[1];
                    prix = prix.toFixed(2);
                    remise = -($("#prix").val()-prix);
                    $("#prix_total").val(prix);
                    $("#total").html(prix+" €");
                    $("#remise").html(remise+" €");
                    $("#affcode").html(res[2]);

                }
                else {
                    $("#valide").hide();
                    $("#invalide").show();
                }
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },

            complete : function(resultat, statut){

            }

        });
    }

    function utiliserPoints(){
        const nbPoints = $("#points").val();
        var prix = $("#prix").val();
        var equivalent = $("#equivalent").val();

        $.ajax({
            url : 'utiliser_points',
            type : 'GET',
            dataType : 'html',
            data : {nbPoints:nbPoints},
            success : function(code_html, statut){
                var res = code_html;
                var remise;
                if(res) {
                    $("#valide2").show();
                    $("#invalide2").hide();
                    $("#affichage2").css("display","flex");
                    $("#affichage2").show();
                    prix-=nbPoints*equivalent;
                    prix = prix.toFixed(2);
                    remise = -($("#prix").val()-prix);
                    $("#prix_total").val(prix);
                    $("#total").html(prix+" €");
                    $("#remise2").html(remise+" €");
                    $("#affpoints").html(nbPoints);
                    $("#pointsTotal").val($("#pointsTotal").val()-nbPoints);

                }
                else {
                    $("#valide2").hide();
                    $("#invalide2").show();
                }
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },

        });
    }
</script>


