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
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>

                                </div>
                            @endif
                            @auth()
                                @if(Auth::user()->role=='admin')
                                    <button type="button"  class="btn btn-outline-primary" data-toggle="modal" data-target="#modal_carousel_ajouter">
                                        Ajouter un element au carousel
                                    </button>
                                    <button type="button"  class="btn btn-outline-primary" data-toggle="modal" data-target="#modal_carousel">
                                        Modifier carousel
                                    </button>

                                    <div class="modal fade" id="modal_carousel_ajouter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">AJouter un element au carousel</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('accueil_carousel_ajouter')}}" id="formu_carousel" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group row" >
                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Image</label>
                                                            <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                                <input type="file" name="image_carousel" id="image_carousel_{{$key->id}}"  class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" >
                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Titre carousel</label>
                                                            <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                                <input type="text" name="titre_carousel" id="titre_carousel_{{$key->id}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" >
                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Couleur titre</label>
                                                            <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                                <input type="color" value="#DCDCDC" name="titre_couleur" id="titre_couleur_{{$key->id}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" >
                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Texte carousel</label>
                                                            <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                                <input type="text" name="texte_carousel" id="texte_carousel_{{$key->id}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" >
                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Couleur texte</label>
                                                            <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                                <input type="color" value="#DCDCDC" name="texte_couleur" id="texte_couleur_{{$key->id}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id_carousel" value="{{$key->id}}">
                                                        <div class="form-group row" >
                                                            <label for="staticEmail" class="col-sm-3 col-form-label">Couleur fond</label>
                                                            <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                                <input type="color" value="#DCDCDC" name="fond_couleur" id="fond_couleur_{{$key->id}}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit"  class="btn btn-success">Valider</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endauth
                            <div id="carouselExampleIndicators" class="mb-3 carousel slide" data-ride="carousel"><!-- Ajuster les images -->

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
                                                <img id="image_{{$key->id}}" src="{{$key->image_carousel}}" class="d-block w-100" alt="First slide">
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
                                                <img id="image_{{$key->id}}" src="{{$key->image_carousel}}" class="d-block w-100" alt="First slide">
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
                            <div class="modal fade" id="modal_carousel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="">Modifier carousel</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span id="close_modal" aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <select onchange="afficher_form_carousel(this.value)">
                                            <option value="">--Please choose an option--</option>>
                                            <?php $var=1; ?>
                                            @foreach($carousel as $key)
                                                <option id="optioncarousel{{$key->id}}"  value="{{$key->id}}">{{$var++}}</option>
                                            @endforeach
                                        </select>
                                        <form action="{{route('accueil_carousel')}}" id="formu_carousel" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body card" style="margin: 2em;" id="modal_div">
                                                <!-- affichage formulaire en ajax -->
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
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
                        <!--<div class="col-lg-12">
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
                        -->
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
                    <div class="card-header bg-danger">Notre Localisation<span class="fas fa-map-marked-alt float-right mt-1"></span>
                        <p><small>n°112 rue de la gare,<br>51100 REIMS</small></p>
                    </div>
                    <div class="card-body">
                        <section class="row">
                            <div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2602.004943824818!2d4.1130172159140965!3d49.2952494778007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e99d86f90099cd%3A0x33bb405513e3549d!2sPlace%20de%20la%20Gare%2C%2051100%20Reims!5e0!3m2!1sfr!2sfr!4v1588795280366!5m2!1sfr!2sfr" width="225" height="200" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
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
