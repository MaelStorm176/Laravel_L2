@extends('layouts.adm')
@section('titre')
    SECONDAIRE<span class="fas fa-cog mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <!-- Carousel -->
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
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
                                    <img id="image_{{$key->id}}" src="../{{$key->image_carousel}}" class="d-block w-100" alt="First slide">
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
                                    <img id="image_{{$key->id}}" src="../{{$key->image_carousel}}" class="d-block w-100" alt="First slide">
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
            <div class="col-lg-6 mb-3">
                <button type="button"  class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#modal_carousel_ajouter">
                    Ajouter un element au carousel
                </button>
            </div>
            <div class="col-lg-6 mb-3">
                <button type="button"  class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#modal_carousel">
                    Modifier carousel
                </button>
            </div>
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Partenaires<span class="fas fa-handshake mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Lien du site</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-secondary text-white">
                                <tr>
                                    <td>PARTENAIRE 1</td>
                                    <td><a href="#">http://partenaire1.com</a></td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                                <tr>
                                    <td>PARTENAIRE 2</td>
                                    <td><a href="#">http://partenaire2.com</a></td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                                <tr>
                                    <td>PARTENAIRE 1</td>
                                    <td><a href="">http://partenaire3.com</a></td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary text-white w-100" data-toggle="modal" data-target="#ajoutModalCenterCode">
                            AJOUTER UN PARTENAIRE
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Réseaux Sociaux<span class="fas fa-globe mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Lien</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-secondary text-white">
                                <tr>
                                    <td>FACEBOOK</td>
                                    <td><a href="#">http://liendufb.com</a></td>
                                    <td><span class="fas fa-edit"></span></td>
                                </tr>
                                <tr>
                                    <td>TWITTER</td>
                                    <td><a href="#">http://lientwitter.com</a></td>
                                    <td><span class="fas fa-edit"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<!-- MODAL AJOUT PARTENAIRE -->
<div class="modal fade" id="ajoutModalCenterCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLongTitleCode">Ajouter un partenaire</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0">
                <div class="modal-body">
                    <section class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" class="form-control">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="lien">Lien du site</label>
                            <input type="text" id="lien" class="form-control">
                        </div>
                    </section>
                </div>    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" id="upload" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL AJOUTER CAROUSEL -->
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
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-5" style="margin-bottom: 1.5em">
                            <input type="file" name="image_carousel" id="image_carousel_{{$key->id}}"  class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
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
<!-- MODAL MODIFIER CAROUSEL -->
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
<script>
    function afficher_form_carousel(id) {
        var dummy = Date.now();
        $.ajax({
            url :'../afficher_form_carousel',
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
            url :'../afficher_form_carousel',
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
