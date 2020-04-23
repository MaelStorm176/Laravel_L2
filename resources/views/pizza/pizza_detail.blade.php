@extends('layouts.app')
<head>
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/pizza.css" rel="stylesheet">
</head>
@section('content')
@foreach($pizza as $key)
@endforeach

<!--Main layout-->
<main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">

        <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-md-6 mb-4">

                <img src="../{{$key->photo}}" class="img-fluid img-pizza" alt="" style="float: right;">

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">

                <!--Content-->
                <div class="p-4">

                    <div class="mb-3">
                        <a href="{{route('pizza_all')}}">
                            <span class="badge purple mr-1">Pizza</span>
                        </a>
                        <a href="">
                            <span class="badge blue mr-1">New</span>
                        </a>
                        <a href="">
                            <span class="badge red mr-1">Bestseller</span>
                        </a>
                        @auth
                            @if(Auth::user()->id==1 && Auth::user()->username=="admin")
                            <a onclick="afficher_promo()">
                                <span class="badge badge-danger mr-1">Appliquer une promotion</span>
                            </a>
                            <div class="input-group mb-3" id="div-promotion" style="display: none;">
                                <form action="{{route('promotion')}}" method="post">
                                    @csrf
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                        <input type="hidden" value="{{$key->id}}" name="id">
                                        <input type="number" class="form-control" id="input-promotion" name="promotion" placeholder="Promotion">
                                    </div>
                                </form>
                            </div>
                        @endif
                        @endauth
                    </div>

                    <p class="lead">
                        @if($key->promo < $key->prix && $key->promo > 0)
                            <span class="mr-1">
                                <del>{{$key->prix}} €</del>
                            </span>
                            <span>{{$key->promo}} €</span>

                            @else
                            <span>{{$key->prix}} €</span>
                        @endif
                    </p>

                    <p class="lead font-weight-bold">Description</p>

                    <p> <em> {{$key->description_courte}} </em> </p>
                    <p> {{$key->description_longue}} </p>

                    @auth
                    <form class="d-flex justify-content-left" action="{{route('panier.ajouter')}}">
                        <!-- Default input -->
                        <input type="number" name="quantite" value="1" aria-label="Search" class="form-control" style="width: 100px">
                        <input type="hidden" value="{{$key->id}}" name="id_pizza">
                        <button class="btn btn-primary btn-md my-0 p" type="submit">Ajouter à votre panier
                            <i class="fas fa-shopping-cart ml-1"></i>
                        </button>
                    </form>
                    @endauth

                    @guest
                        <a href="{{route('login')}}"><button class="btn btn-primary btn-md my-0 p">Pour commander, connectez vous !</button></a>
                    @endguest

                </div>
                <!--Content-->

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <hr>

        <!--Grid row-->
        <div class="row d-flex justify-content-center wow fadeIn">

            <!--Grid column-->
            <div class="col-md-6 text-center">

                <h4 class="my-4 h4">Informations complémentaires</h4>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit
                    voluptates,
                    quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.</p>

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row wow fadeIn">
            <table>
                <tbody>
                <tr></tr>
                </tbody>
            </table>
        </div>
        <!--Grid row-->

    </div>
</main>
<!--Main layout-->

@endsection

<!-- SCRIPTS -->
<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>
<!-- Initializations -->
<script type="text/javascript">
    function afficher_promo() {
        $('#div-promotion').show();
    }
</script>
