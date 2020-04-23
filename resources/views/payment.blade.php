@extends('layouts.app')
<head>
    <!-- Material Design Bootstrap -->
     <link href="/css/mdb.min.css" rel="stylesheet">
</head>
@section('content')
    <!--Main layout-->
    <main class="mt-5 pt-4">
        <div class="container wow fadeIn">
            <!-- Heading -->
            <h2 class="my-5 h2 text-center">Paiement</h2>
            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-8 mb-4">

                    <!--Card-->
                    <div class="card">

                        <!--Card content-->
                        <form class="card-body"
                            role="form"
                            action="{{ route('stripe.post') }}"
                            method="post"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                            id="payment-form">
                            @csrf
                            <?php
                            $user =Auth::user()->id;
                            $email =Auth::user()->email;
                            ?>
                            <input value="<?php echo $email;?>" name="user_email" type="hidden">
                            <input value="<?php echo $user;?>" name="user_id" type="hidden">
                            <input value="{{$prix_total}}" name="prix_total" type="hidden">
                            <input value="{{$products}}" name="products" type="hidden">
                            <input value="com_{{auth::user()->id}}_{{$prix_total}}" name="num_commande" type="hidden">
                            <!--Grid row-->
                            <div class="row">

                                <!--Grid column-->
                                <div class="col-md-6 mb-2">

                                    <!--firstName-->
                                    <div class="md-form ">
                                        <input type="text" id="firstName" class="form-control" placeholder="Prénom" value="{{auth::user()->first_name}}">
                                    </div>

                                </div>
                                <!--Grid column-->

                                <!--Grid column-->
                                <div class="col-md-6 mb-2">

                                    <!--lastName-->
                                    <div class="md-form">
                                        <input type="text" id="lastName" class="form-control" placeholder="Nom de famille" value="{{auth::user()->last_name}}">
                                    </div>

                                </div>
                                <!--Grid column-->

                            </div>
                            <!--Grid row-->

                            <!--address-->
                            <div class="md-form mb-5">
                                <input type="text" id="address" placeholder="Adresse" class="form-control">
                            </div>

                            <!-- BOUTONS RADIO PAYPAL / CC  -->
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="credit">Carte de crédit</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="row">
                                <!-- NOM CARTE CREDIT -->
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Nom sur votre carte</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="Ex : JEAN DUPONT" required>
                                    <small class="text-muted">Veuillez écrire le nom présent sur votre carte en majuscule</small>
                                    <div class="invalid-feedback">
                                        Le nom est requis
                                    </div>
                                </div>
                                <!-- N° CARTE CREDIT -->
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">N° Carte de crédit</label>
                                    <input type="text" class="form-control" id="cc-number" name="card_number" placeholder="Ex : 5678 2345 7418 5693" required>
                                    <div class="invalid-feedback">
                                        Le N° de carte est requis
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- DATE EXPIRATION -->
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" name="card_mm_yyyy" placeholder="MM/YYYY" required>
                                    <div class="invalid-feedback">
                                        La date d'expiration est requise
                                    </div>
                                </div>
                                <!-- CVV -->
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">CVV</label>
                                    <input type="text" class="form-control" id="card_cvc" name="card_cvc" placeholder="Ex : 123" required>
                                    <div class="invalid-feedback">
                                        Le code de sécurité est requis
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <!-- BOUTON DE VALIDATION -->
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Valider le paiement</button>

                        </form>

                    </div>
                    <!--/.Card-->

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-4 mb-4">

                    <!-- Heading -->
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Votre panier</span>
                        <span class="badge badge-secondary badge-pill">{{$q_tot}} articles</span>
                    </h4>

                    <!-- Panier -->
                    <ul class="list-group mb-3 z-depth-1">
                        @foreach($products as $key)
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{$key->nom}} x {{$key->quantite}}</h6>
                                    <small class="text-muted">{{$key->statut}}</small>
                                </div>
                                <span class="text-muted">{{$key->promo}} €</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>EXAMPLECODE</small>
                            </div>
                            <span class="text-success">-$5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">TOTAL</h6>
                                <small class="text-muted">TTC</small>
                            </div>
                            <span class="text-muted"><strong> {{$prix_total}} € </strong></span>
                        </li>
                    </ul>
                    <!-- Panier -->

                    <!-- Promo code -->
                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Code promo" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-secondary btn-md waves-effect m-0" type="button">APPLIQUER</button>
                            </div>
                        </div>
                    </form>
                    <!-- Promo code -->

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

        </div>
    </main>
    <!--Main layout-->
@endsection

@section('script')
<!-- Initializations -->
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- JQUERY -->
<script
    src="https://code.jquery.com/jquery-3.5.0.min.js"
    integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.0.1/jquery.payment.min.js"></script>


<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">

    $(function() {

        var $form=$(".require-validation");

        $('form.require-validation').bind('submit', function(e) {
            var $form= $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'].join(', '),
                $inputs       = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid         = true;
            $errorMessage.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }

        });

        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });

</script>
@endsection


