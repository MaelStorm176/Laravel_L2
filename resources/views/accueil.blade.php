@extends('layouts.base')
@section('content')

    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger">
                    <section class="row">
                        <div class="col-lg-2"><strong class="panel-title">Offre du moment:</strong></div>
                        <marquee class="col-lg-10" onmouseout="this.start();" onmouseover="this.stop();" >
                            Promotions ! @foreach($pizza as $key) @if($key->promo < $key->prix) {{$key->nom}} -> <strong>{{$key->promo}} € </strong>  @endif @endforeach
                        </marquee>
                    </section>
                </div>
            </div>
        </section>
        <section class="row">
            <div class="col-lg-9 pl-0">
                <div class="container-fluid">
                    <section class="row">
                        <div class="col-lg-12">
                            <!-- Carousel -->
                            <div id="carouselExampleIndicators" class="mb-3 carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="img/carousel.jpg" class="d-block w-100" alt="First slide">
                                        <div class="carousel-caption d-none d-md-block jumbotron p-3 text-center text-info shadow">
                                            <h5>First slide label</h5>
                                            <p class="m-0">Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/carousel.jpg" class="d-block w-100" alt="Second slide">
                                        <div class="carousel-caption d-none d-md-block jumbotron p-3 text-center text-info shadow">
                                            <h5>Second slide label</h5>
                                            <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/carousel.jpg" class="d-block w-100" alt="Third slide">
                                        <div class="carousel-caption d-none d-md-block jumbotron p-3 text-center text-info shadow">
                                            <h5>Third slide label</h5>
                                            <p class="m-0">Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <!-- FIN Carousel -->

                        </div>
                        <div class="col-lg-12">
                            <div class="card bg-danger mb-3">
                                <div class="card-body">
                                    <marquee onmouseout="this.start();" onmouseover="this.stop();">
                                        @foreach($pizza as $key)
                                            <div style="width: 150px; height: 150px; display: inline-block;">
                                                <a href="pizza_all/{{$key->nom}}">
                                                    <img class="mr-3 img-thumbnail" src="{{$key->photo}}"  alt="" data-toggle="tooltip" data-placement="bottom" title="{{$key->nom}}" />
                                                </a>
                                            </div>
                                        @endforeach
                                    </marquee>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="list-group mb-3">
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h4 class="mb-1">NOM Prénom</h4>
                                        <span class="badge badge-success p-2 rounded-circle shadow">5/5</span>
                                    </div>
                                    <p class="mb-1 text-justify">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                    <small>20/04/2020</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h4 class="mb-1">NOM Prénom</h4>
                                        <span class="badge badge-warning p-2 rounded-circle text-white shadow">3/5</span>
                                    </div>
                                    <p class="mb-1 text-justify">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                    <small class="text-muted">20/04/2020</small>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h4 class="mb-1">NOM Prénom</h4>
                                        <span class="badge badge-danger p-2 rounded-circle shadow">1/5</span>
                                    </div>
                                    <p class="mb-1 text-justify">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                    <small class="text-muted">20/04/2020</small>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <section class="col-lg-3">
                <div class="card text-white border-success mb-3">
                    <div class="card-header bg-success">Nous Contacter<span class="fas fa-phone float-right mt-1"></span></div>
                    <div class="card-body">
                        <section class="row">
                            <div class="col text-center text-info jumbotron p-1 mb-0">03.78.98.34.15</div>
                        </section>
                    </div>
                </div>
                <div class="card text-white border-danger mb-3">
                    <div class="card-header bg-danger">Notre Localisation<span class="fas fa-map-marked-alt float-right mt-1"></span></div>
                    <div class="card-body">
                        <section class="row">
                            <div class="col text-center text-info jumbotron p-1 mb-0">n°112 rue de la gare,<br>51100 REIMS</div>
                        </section>
                    </div>
                </div>
                <div class="card text-white border-success mb-3">
                    <div class="card-header bg-success">Réseaux Sociaux<span class="fas fa-globe float-right mt-1"></span></div>
                    <div class="card-body">
                        <section class="row justify-content-center">
                            <div class="col p-0">
                                <img src="img/twitter.jpg" alt="Notre Facebook!" class="float-right" data-toggle="tooltip" data-placement="left" title="Rejoins nous sur Twitter!"/>
                            </div>
                            <div class="col p-0">
                                <img src="img/facebook.jpg" alt="Notre Twitter!" class="float-left" data-toggle="tooltip" data-placement="right" title="Rejoins nous sur Facebook!"/>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="card text-white border-danger mb-3">
                    <div class="card-header bg-danger">Nos partenaires<span class="fas fa-handshake float-right mt-1"></span></div>
                    <div class="card-body">
                        <ul class="list-group">
                            <a href="#" class="text-decoration-none">
                                <li class="list-group-item list-group-item-primary rounded-0" data-toggle="tooltip" data-placement="left" title="http://partenaire1.com">
                                    Partenaire1<span class="fas fa-link float-right mt-1"></span>
                                </li>
                            </a>
                            <a href="#" class="text-decoration-none">
                                <li class="list-group-item list-group-item-secondary rounded-0" data-toggle="tooltip" data-placement="left" title="http://partenaire2.com">
                                    Partenaire2<span class="fas fa-link float-right mt-1"></span>
                                </li>
                            </a>
                            <a href="#" class="text-decoration-none">
                                <li class="list-group-item list-group-item-primary rounded-0" data-toggle="tooltip" data-placement="left" title="http://partenaire3.com">
                                    Partenaire3<span class="fas fa-link float-right mt-1"></span>
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="card text-white border-success mb-3">
                    <div class="card-header bg-success">Newsletter<span class="fas fa-envelope-square float-right mt-1"></span></div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="adresse mail" aria-label="adresse mail" aria-describedby="button-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-outline-primary" type="button" id="button-addon2">S'inscrire</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
@endsection
