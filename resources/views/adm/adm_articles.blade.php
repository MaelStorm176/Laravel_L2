@extends('layouts.adm')
@section('titre')
    ARTICLES<span class="fas fa-pizza-slice mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-6 mb-3">
                <button type="button" id="bouton_ajout" onclick="ajouter()" class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#exampleModalCenter">
                    Ajouter un article
                </button>
            </div>
            <div class="col-lg-6 mb-3">
                <button type="button" id="bouton_code" onclick="ajouterCate()" class="btn btn-outline-primary w-100" data-toggle="modal" data-target="#exampleModalCenterCode">
                    Ajouter une catégorie
                </button>
            </div>
            <div class="col-lg-12">
                <div class="card bg-dark mb-3 pl-0 pr-3 pt-3 pb-0">
                    <div class="container">
                        <section class="row">
                            @foreach($categorie as $cat)
                                <div class="col-lg-3 text-center mb-3">
                                    <section class="row">
                                        <div class="col-10 pr-0">
                                            <button class="btn btn-primary text-white w-100" name="{{$cat->nom}}" type="button" data-toggle="collapse" data-target="#{{$cat->nom}}Collapse" aria-expanded="true" aria-controls="{{$cat->nom}}Collapse">
                                                Nos {{$cat->nom}}
                                            </button>
                                        </div>
                                        <div class="col-lg-2 px-0">
                                            <button class="btn btn-primary w-100 h-100" onclick="cate_suppr({{$cat->id}})" type="button" id="cate_{{$cat->id}}" name="cate_suppr" data-toggle="modal" data-target=".bd-example-modal-sm">
                                                <span class="fas fa-times text-danger"></span>
                                            </button>
                                        </div>
                                    </section>
                                </div>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="accordion" id="accordionEx">
                    @foreach($categorie as $cat)
                        <!-- COLLAPSES -->
                        <div class="collapse" id="{{$cat->nom}}Collapse" data-parent="#accordionEx">
                            <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                                <h5 class="mb-0 text-uppercase">NOS {{$cat->nom}}</h5>
                            </div>
                            <div class="row row-cols-1 row-cols-md-2">
                                @foreach($pizza as $key)
                                    @if($key->categorie == $cat->nom)
                                        @if($key->statut == 'Disponible')
                                            <div class="col mb-3" id="{{$key->id}}">
                                                <div class="card">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4">
                                                            <a href="../pizza_all/{{$key->nom}}" target="_blank">
                                                            <img src="../{{$key->photo}}" class="rounded-left w-100 h-100">
                                                            </a>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                @if($key->promo < $key->prix)
                                                                    <div class="badge badge-danger p-2 float-right text-white"><del>{{$key->prix}}</del> {{$key->promo}} €</div>
                                                                @else
                                                                    <div class="badge badge-primary p-2 float-right text-white"> {{$key->promo}} €</div>
                                                                @endif
                                                                <h5 class="card-title mt-1">{{$key->nom}}</h5>
                                                                <p class="card-text text-justify">{{$key->description_courte}}</p>
                                                                <section class="row">
                                                                    <div class="col-lg-6 mb-3">
                                                                        <button type="button" class="btn btn-success w-100" onclick="modifier({{$key->id}})" data-toggle="modal" data-target="#exampleModalCenter">
                                                                            MODIFIER
                                                                        </button>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-3">
                                                                        <button type="button" class="btn btn-danger w-100" onclick="supprimer({{$key->id}})">
                                                                            SUPPRIMER
                                                                        </button>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col mb-3" id="{{$key->id}}" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);">
                                                <div class="card">
                                                    <div class="row no-gutters">
                                                        <div class="col-md-4">
                                                            <img src="../{{$key->photo}}" class="rounded-left w-100 h-100">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">
                                                                @if($key->promo < $key->prix)
                                                                    <div class="badge badge-danger p-2 float-right text-white"><del>{{$key->prix}}</del> {{$key->promo}} €</div>
                                                                @else
                                                                    <div class="badge badge-primary p-2 float-right text-white"> {{$key->promo}} €</div>
                                                                @endif
                                                                <h5 class="card-title mt-1">{{$key->nom}}</h5>
                                                                <p class="card-text text-justify">{{$key->description_courte}}</p>
                                                                <section class="row">
                                                                    <div class="col-lg-6 mb-3">
                                                                        <button type="button" class="btn btn-success w-100" onclick="modifier({{$key->id}})" data-toggle="modal" data-target="#exampleModalCenter">
                                                                            MODIFIER
                                                                        </button>
                                                                    </div>
                                                                    <div class="col-lg-6 mb-3">
                                                                        <button type="button" class="btn btn-danger w-100" onclick="supprimer({{$key->id}})">
                                                                            SUPPRIMER
                                                                        </button>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <button type="button" class="btn btn-primary w-100" onclick="promotion({{$key->id}})" data-toggle="modal" data-target="#exampleModalCenterCode">
                                                                            AJOUTER PROMOTION
                                                                        </button>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>

<!-- MODAL AJOUT ARTICLES -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="overflow:scroll; height:750px;">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ajouter une pizza</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <form action="{{ route('pizza.upload') }}" id="formu" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label>Image de votre article</label>
                            <small><i>(Selectionnez une image aux dimensions carrées, ex : 200 x 200)</i></small>
                            <br/>
                            <input type="file" name="image" id="image" class="form-control" required style="width:300px; display: inline-block;" onchange="update_Photo();">
                            <input type="hidden" name="image_base" id="image_base">
                            <img id="image_affiche" src="{{asset('images/img_seed/1.jpg')}}" style="width:150;"/>
                            <br/> <br/>
                            <label>Nom de votre article</label>
                            <input type="text" name="nom_p" placeholder="Nom" id="nom_p" class="form-control" required>
                            <br/>
                            <label>Catégorie de votre article (Pizza, pâtes, dessert...)</label>
                            <select name="categorie" class="custom-select" id="categorie" required>
                                <option value="">>-- Choisissez une catégorie --<</option>
                                @foreach($categorie as $cate)
                                    <option value="{{$cate->nom}}">{{$cate->nom}}</option>
                                @endforeach
                            </select>
                            <br/><br/>
                            <label>Description brève de l'article</label>
                            <small><i>(Optionnel)</i></small>
                            <textarea name="description_courte" id="description_courte" class="form-control" rows="3"></textarea>
                            <br/>
                            <label>Description détaillée de l'article</label>
                            <small><i>(Optionnel)</i></small>
                            <textarea name="description_longue" id="description_longue" class="form-control" rows="5"></textarea>
                            <br/>
                            <label>Prix (Euros €)</label>
                            <input type="number" step="0.01" name="prix_p" placeholder="Prix" id="prix_p" class="form-control" required>
                            <br/>
                            <input type="hidden" name="id_pizza" id="id_pizza">
                            <label>Disponibilité de votre article</label>
                            <select name="statut_p" class="custom-select" id="statut_p">
                                <option value="">>-- Disponibilité --<</option>
                                <option value="Disponible">Disponible</option>
                                <option value="Indisponible">Indisponible</option>
                            </select>
                        </div>
                        <br/>
                        <div>
                            <label>Valeurs nutritionnelles</label>
                            <small><i>(Optionnel)</i></small>
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Sodium (mg)</th>
                                    <th scope="col">Fibres (g)</th>
                                    <th scope="col">Dont_satures (g)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="number" step="0.1" class="form-control" id="sodium" name="sodium" min="0" ></td>
                                    <td><input type="number" step="0.1" class="form-control" id="fibres" name="fibres" min="0" ></td>
                                    <td><input type="number" step="0.1" class="form-control" id="dont_satures" name="dont_satures" min="0" ></td>
                                </tr>
                                </tbody>
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Lipides (g)</th>
                                    <th scope="col">Dont_sucres (g)</th>
                                    <th scope="col">Glucides (g)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="number" step="0.1" class="form-control" id="lipides" name="lipides" min="0" ></td>
                                    <td><input type="number" step="0.1" class="form-control" id="dont_sucres" name="dont_sucres" min="0" ></td>
                                    <td><input type="number" step="0.1" class="form-control" id="glucides" name="glucides" min="0" ></td>
                                </tr>
                                </tbody>
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Proteines (g)</th>
                                    <th scope="col">Energies (kcal)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><input type="number" step="0.1" class="form-control" id="proteines" name="proteines" min="0" ></td>
                                    <td><input type="number" step="0.1" class="form-control" id="energies" name="energies" min="0" ></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" id="upload" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- MODAL AJOUT CATEGORIE -->
<div class="modal fade" style="z-index:200000;" id="exampleModalCenterCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLongTitleCode">Ajouter une catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categorie.upload') }}" id="formucode" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div>
                        <label id="label_cate" for="nom">Nom de la catégorie</label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                        <input type="hidden" id="id" name="id" value="">
                        </br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" id="upload" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIN MODAL -->
<!-- MODAL SUPPRESSION -->
<div class="modal fade bd-example-modal-sm" style="z-index:200000;" id="modal_suppression" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLongTitleCode">Suppression d'une catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categorie.supprimer') }}" id="formu_supp" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div>
                        <label id="label_cate" for="nom">Attention ! La suppression de cette catégorie entraine la suppression de tous les articles dépendant de celle ci. Etes-vous sûr ?</label>
                        <!-- Default checked -->
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="defaultChecked_oui" name="choix" value="oui" checked>
                            <label class="custom-control-label" for="defaultChecked_oui">Oui</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="defaultChecked_non" name="choix" value="non">
                            <label class="custom-control-label" for="defaultChecked_non">Non</label>
                        </div>
                        <input type="hidden" id="id_cate" name="id_cate" value="">
                        </br>
                    </div>
                    <div class="modal-footer" style="height: 40px">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" id="upload" class="btn btn-primary">Confirmer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIN MODAL -->
@endsection

<script>
    //Vide le formulaire afin d'ajouter une pizza
    function ajouter(){
        $('#exampleModalLongTitle').html('Ajouter une pizza');
        $('#formu').prop('action','{{route('pizza.upload')}}');
        $('#upload').html('Ajouter');
        $('#nom_p').val('');
        $('#categorie').val('');
        $('#description_courte').val('');
        $('#description_longue').val('');
        $('#prix_p').val('');
        $('#pet-select').val('');
        $('#image_affiche').hide();
        $('#image_base').val("");
    }

    //Rempli le formulaire afin de modifier la pizza selectionnée
    function modifier(id) {
        $('#exampleModalLongTitle').html('Modifier pizza');
        $('#formu').prop('action','{{route('pizza.modifier')}}');
        $('#upload').html('Modifier');
        $('#id_pizza').val(id);
        var dummy = Date.now();
        $.ajax({
            url :'{{route('afficher_form')}}',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                var dataretour = code_html.split('_|');
                $('#image_affiche').show();
                $('#image_base').val(dataretour[0]);
                $('#image_affiche').attr("src",'../'+dataretour[0]);
                $('#nom_p').val(dataretour[1]);
                $('#categorie').val(dataretour[2]);
                $('#description_courte').val(dataretour[3]);
                $('#description_longue').val(dataretour[4]);
                $('#prix_p').val(dataretour[5]);
                $('#statut_p').val(dataretour[6]);
                $('#sodium').val(dataretour[7]);
                $('#fibres').val(dataretour[8]);
                $('#dont_satures').val(dataretour[9]);
                $('#lipides').val(dataretour[10]);
                $('#dont_sucres').val(dataretour[11]);
                $('#glucides').val(dataretour[12]);
                $('#proteines').val(dataretour[13]);
                $('#energies').val(dataretour[14]);
            },
            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }

    function promotion(id){
        $('#exampleModalLongTitleCode').html('Ajouter une promotion');
        $('#formucode').prop('action','{{route('promotion')}}');
        $('#nom').prop('name','promotion');
        $('#label_cate').html("Promotion sur l'article (en %)");
        $('#id').val(id);
    }

    function ajouterCate() {
        $('#exampleModalLongTitleCode').html('Ajouter une catégorie');
        $('#formucode').prop('action','{{route('categorie.upload')}}');
        $('#nom').prop('name','nom');
        $('#label_cate').html("Ajouter une catégorie d'articles (Boissons, pizzas...)");
        $('#id').val('');
    }

    function cate_suppr(id) {
        $('#id_cate').val(id);
    }

    function supprimer(id){
        var dummy = Date.now();
        $.ajax({
            url : '{{route('pizza.supprimer')}}',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                $('div[id="'+id+'"]').remove();
            },
            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }
</script>
