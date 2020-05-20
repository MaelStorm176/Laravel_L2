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
                                <div class="carousel-inner">
                                    <ol class="carousel-indicators">
                                        <?php $var=0; ?>
                                        @foreach($carousel as $key)
                                            @if($var==0)
                                                <li data-target="#carouselExampleIndicators" id="carousel_li_{{$key->id}}" data-slide-to="{{$var}}" class="active"></li>
                                            @else
                                                <li data-target="#carouselExampleIndicators" id="carousel_li_{{$key->id}}" data-slide-to="{{$var}}"></li>
                                            @endif
                                            <?php $var++; ?>
                                        @endforeach
                                    </ol>
                                    <?php $var=0; ?>
                                    @foreach($carousel as $key)
                                        @if($var==0)
                                            <div class="carousel-item active" id="carousel_div_{{$key->id}}">
                                                <img id="image_{{$key->id}}" src="{{$key->image_carousel}}" class="w-100" style="height:28rem;" alt="slide">
                                                @if($key->titre_carousel==NULL && $key->texte_carousel==NULL)
                                                @else
                                                    <div id="fond_couleur_{{$key->id}}" style="background-color: {{$key->fond_couleur}}" class="carousel-caption d-none d-md-block jumbotron p-3 text-center text-info shadow">
                                                        <h5 id="titre_{{$key->id}}" style="color: {{$key->titre_couleur}}">{{$key->titre_carousel}}</h5>
                                                        <p id="texte_{{$key->id}}" style="color: {{$key->texte_couleur}}" class="m-0">{{$key->texte_carousel}}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <div class="carousel-item" id="carousel_div_{{$key->id}}">
                                                <img id="image_{{$key->id}}" src="{{$key->image_carousel}}" class="w-100" style="height:28rem;" alt="slide">
                                                @if($key->titre_carousel==NULL && $key->texte_carousel==NULL)
                                                @else
                                                    <div id="fond_couleur_{{$key->id}}" style="background-color: {{$key->fond_couleur}}" class="carousel-caption d-none d-md-block jumbotron p-3 text-center text-info shadow">
                                                        <h5 id="titre_{{$key->id}}" style="color: {{$key->titre_couleur}}">{{$key->titre_carousel}}</h5>
                                                        <p id="texte_{{$key->id}}" style="color: {{$key->texte_couleur}}" class="m-0">{{$key->texte_carousel}}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                        <?php $var++; ?>
                                    @endforeach
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
                            <div class="card border-one mb-3">
                                <div class="card-body bg-one">
                                    <marquee onmouseout="this.start();" onmouseover="this.stop();">
                                        @foreach($pizza as $key)
                                            <a href="pizza_all/{{$key->nom}}">
                                                <img class="w-25 mr-3 img-thumbnail" style="height:10rem" src="{{$key->photo}}" alt="pizza" data-toggle="tooltip" data-placement="bottom" title="{{$key->nom}}" />
                                            </a>
                                        @endforeach
                                    </marquee>
                                </div>
                                <div class="card-footer bg-two text-center">
                                    <h5 class="text-two m-0">Nos pizzas du moment</h5>
                                </div>
                            </div>
                        </div>
                        <!-- LES 3 DERNIERS COMMENTAIRES -->
                        <div class="col-lg-12">
                            <div class="list-group mb-3 border-0">
                                <div class="text-white border-one mb-3">
                                    <div class="card-header bg-one text-one">
                                        Les 3 derniers avis
                                        <span class="fas fa-comment float-right mt-1"></span>
                                    </div>
                                    <div class="list-group mb-3">
                                        @foreach($commentaires as $key)
                                            <a href="#" class="list-group-item list-group-item-action list-group-item-primary">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h4 class="mb-1">{{$key->username}}</h4>
                                                    <span class="badge badge-success p-2 rounded-circle shadow">{{$key->note}}</span>
                                                </div>
                                                <p class="mb-1 text-justify">{{$key->commentaire}}</p>
                                                <small>{{$key->created_at}}</small>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <section class="col-lg-3">
                <div class="card border-one mb-3">
                    <div class="card-header bg-one text-one">Nous Contacter<span class="fas fa-phone float-right mt-1"></span></div>
                    <div class="card-body">
                        <section class="row">
                            @foreach($parametres as $key)
                                <div class="col text-center text-info jumbotron p-1 mb-0">{{$key->telephone}}</div>
                            @endforeach
                        </section>
                    </div>
                </div>
                <div class="card text-two border-two mb-3">
                    <div class="card-header bg-two">Notre Localisation<span class="fas fa-map-marked-alt float-right mt-1"></span></div>
                    <div class="card-body">
                        <section class="row">
                            <div class="col-12 p-0">
                                <iframe class="w-100" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2602.004943824818!2d4.1130172159140965!3d49.2952494778007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e99d86f90099cd%3A0x33bb405513e3549d!2sPlace%20de%20la%20Gare%2C%2051100%20Reims!5e0!3m2!1sfr!2sfr!4v1588795280366!5m2!1sfr!2sfr" width="225" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </section>
                    </div>
                    <div class="card-footer bg-two">
                        @foreach($parametres as $key)
                            <p class="mb-0 text-two"><small>{{$key->adresse}},<br>{{$key->codePostal}} {{$key->ville}}</small></p>
                        @endforeach
                    </div>
                </div>
                <div class="card border-one mb-3">
                    <div class="card-header bg-one text-one">Réseaux Sociaux<span class="fas fa-globe float-right mt-1"></span></div>
                    <div class="card-body">
                        <section class="row justify-content-center">
                            @foreach($parametres as $key)
                                <div class="col p-0">
                                    <a href="{{$key->twitter}}">
                                        <img src="img/twitter.jpg" alt="Notre Facebook!" class="float-right" data-toggle="tooltip" data-placement="left" title="Rejoins nous sur Twitter!"/>
                                    </a>
                                </div>
                                <div class="col p-0">
                                    <a href="{{$key->facebook}}">
                                        <img src="img/facebook.jpg" alt="Notre Twitter!" class="float-left" data-toggle="tooltip" data-placement="right" title="Rejoins nous sur Facebook!"/>
                                    </a>
                                </div>
                            @endforeach
                        </section>
                    </div>
                </div>
                <div class="card border-two mb-3">
                    <div class="card-header bg-two text-two">Nos partenaires<span class="fas fa-handshake float-right mt-1"></span></div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($partenaires as $partenaire)
                                <a href="{{$partenaire->lien}}" class="text-decoration-none">
                                    <li class="list-group-item list-group-item-primary rounded-0" data-toggle="tooltip" data-placement="left" title="{{$partenaire->lien}}">
                                        {{$partenaire->nom}}<span class="fas fa-link float-right mt-1"></span>
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card border-one mb-3">
                    <div class="card-header bg-one text-one">Newsletter<span class="fas fa-envelope-square float-right mt-1"></span></div>
                    <div class="card-body">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="adresse mail" aria-label="adresse mail" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-one" type="button" id="button-addon2">S'inscrire</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card border-two mb-3">
                    <div class="card-header bg-two text-two">Nombre d'utilisateurs total<span class="fas fa-user-circle float-right mt-1"></span></div>
                    <div class="card-body">
                        <div class="col text-center text-info jumbotron p-1 mb-0">{{$nb_user}}</div>
                    </div>
                </div>
            </section>
        </section>
    </div>
@endsection

<script>
    function afficher_form_carousel(id) {
        var dummy = Date.now();
        $.ajax({
            url :'afficher_form_carousel',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                $('#modal_div').html(code_html);
                remplissage(id,1);
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }
    function remplissage(id,action){
        //Rempli le formulaire afin de modifier l'element selectionnée
        var dummy = Date.now();
        $.ajax({
            url :'afficher_form_carousel',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id, action:action},
            success : function(code_html1, statut){
                var dataretour = code_html1.split('|');
                $('#titre_carousel_'+id).val(dataretour[0]);
                $('#titre_couleur_'+id).val(dataretour[1]);
                $('#texte_carousel_'+id).val(dataretour[2]);
                $('#texte_couleur_'+id).val(dataretour[3]);
                $('#couleur_fond_'+id).val(dataretour[4]);

            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }


</script>
