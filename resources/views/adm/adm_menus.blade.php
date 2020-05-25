@extends('layouts.adm')
@section('titre')
    MENUS<span class="fas fa-list-alt mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Liste des menus<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <button type="button" id="bouton_code" onclick="ajouter_menu()"class="btn btn-outline-primary" data-toggle="modal" data-target="#MenuModal">
                            Ajouter un menu
                        </button>
                        <section class="row row-cols-1 row-cols-md-2">
                            @foreach($menus as $menu)
                                <div class="col mb-3" id="menu_{{$menu->id}}">
                                    @if($menu->statut == 'Indisponible')
                                        <div class="card" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);">
                                    @else
                                        <div class="card">
                                    @endif
                                        <div class="row no-gutters">
                                            <div class="col-md-4">
                                                <img src="../img/menus.jpg" class="rounded-left w-100 h-100">
                                             </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    @if($menu->promo < $menu->prix)
                                                        <div class="badge badge-danger p-2 float-right text-white"><del>{{$menu->prix}}</del> {{$menu->promo}} €</div>
                                                    @else
                                                        <div class="badge badge-primary p-2 float-right text-white"> {{$menu->promo}} €</div>
                                                    @endif
                                                    <h5 class="card-title mt-1">{{$menu->nom}}</h5>
                                                    <p class="card-text text-justify">{{$menu->description}}</p>
                                                    <ul class="list-group mb-3">
                                                        @foreach($contenu_menu as $key)
                                                            @if($key->id_menu == $menu->id)
                                                                @foreach($pizza as $item)
                                                                    @if($item->id == $key->id_pizza)
                                                                        <li id="contenu_{{$menu->id}}_{{$item->id}}" onclick="supprimer_contenu({{$menu->id}},{{$item->id}})" class="list-group-item list-group-item-primary rounded-0">
                                                                            {{$item->nom}}
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    <section class="row">
                                                        <div class="col-lg-6 mb-3">
                                                            <button type="button" onclick="modifier_menu({{$menu->id}})" class="btn btn-success w-100" data-toggle="modal" data-target="#MenuModal">MODIFIER</button>
                                                        </div>
                                                        <div class="col-lg-6 mb-3">
                                                            <button type="button" onclick="supprimer_menu({{$menu->id}})" class="btn btn-danger w-100">SUPPRIMER</button>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <button type="button" onclick="ajouter_promo({{$menu->id}})" class="btn btn-primary w-100" data-toggle="modal" data-target="#exampleModalCenterCode">
                                                                AJOUTER PROMOTION
                                                            </button>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

    <!-- FIN DU MODAL -->
        <div class="modal fade" style="z-index:200000;" id="MenuModal" tabindex="-1" role="dialog" aria-labelledby="MenuModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="overflow:scroll; height:750px;">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" id="MenuModalLongTitle">Création d'un menu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('menu.upload') }}" id="formulaire_menu" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label>Nom du menu</label>
                                <input type="text" name="nom_m" placeholder="Nom" id="nom_m" class="form-control" required>
                                <br/>

                                <label>Contenu du menu</label>
                                <ul>
                                    @foreach($categorie as $cate)
                                        <li>
                                            <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                                <input type="checkbox" name="categorie" class="custom-control-input" id="check_box_{{$cate->nom}}" value="{{$cate->nom}}">
                                                <label class="custom-control-label" for="check_box_{{$cate->nom}}">{{$cate->nom}}</label>
                                            </div>
                                        </li>
                                        <ul>
                                            <li>
                                                <div id="aff_{{$cate->nom}}">

                                                </div>
                                            </li>
                                        </ul>
                                    @endforeach
                                </ul>
                                <br/>

                                <label>Description détaillée du menu</label>
                                <small><i>(Optionnel)</i></small>
                                <textarea name="description_m" id="description_m" class="form-control" rows="5"></textarea>
                                <br/>

                                <label>Prix (Euros €)</label>
                                <input type="number" step="0.01" name="prix_m" placeholder="Prix" id="prix_m" class="form-control" required>
                                <br/>
                                <label>Disponibilité de votre menu</label>
                                <select name="statut_m" class="custom-select" id="statut_m">
                                    <option value="">>-- Disponibilité --<</option>
                                    <option value="Disponible">Disponible</option>
                                    <option value="Indisponible">Indisponible</option>
                                </select>
                                <input type="hidden" name="id_menu" id="id_menu">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" id="upload_menu" class="btn btn-primary">Créer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DU MODAL -->


<!-- MODAL AJOUT PROMOTION -->
<div class="modal fade" style="z-index:200000;" id="exampleModalCenterCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLongTitleCode">Ajouter une promotion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('menu.promotion') }}" id="formucode" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div>
                        <label id="label_cate" for="nom">Entrez une promotion (en %)</label>
                        <input type="number" name="promotion" id="promotion" min="0" max="100" class="form-control" required>
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



@section('script')
<script>
    function ajouter_menu()
    {
        $('input[type="checkbox"][name="categorie"]').change().prop('checked', false);
        $('input[type="checkbox"][name="article[]"]').prop('checked', false);
        $('#MenuModalLongTitle').html('Créer un menu');
        $('#formulaire_menu').prop('action','{{route('menu.upload')}}');
        $('#nom_m').val('');
        $('#description_m').val('');
        $('#prix_m').val('');
        $('#statut_m').val('');
        $('#upload_menu').html('Créer');
        $('#id_menu').val('');
    }

    function modifier_menu(id)
    {
        $('input[type="checkbox"][name="categorie"]').prop('checked', false);
        $('input[type="checkbox"][name="article[]"]').prop('checked', false);
        $('#MenuModalLongTitle').html('Modifier le menu');
        $('#formulaire_menu').prop('action','{{route('menu.modifier')}}');
        $('#upload_menu').html('Modifier');
        $('#id_menu').val(id);
        var dummy = Date.now();
        $.ajax({
            url :'{{route('afficher_form_menu')}}',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                var dataretour = code_html.split('_|');
                $('#nom_m').val(dataretour[0]);
                $('#description_m').val(dataretour[1]);
                $('#prix_m').val(dataretour[2]);
                $('#statut_m').val(dataretour[3]);

                for (var i=5;i<=dataretour.length;i+=2){
                    $('input[type="checkbox"][name="categorie"][value='+dataretour[i]+']').change().prop('checked', true);
                }
                setTimeout(function() {
                    for(i=4;i<=(dataretour.length-1);i+=2){
                        $('input[type="checkbox"][name="article[]"][value='+dataretour[i]+']').change().prop('checked', true);
                    }
                }, 1000);

            },
            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }

    function supprimer_menu(id){
        var dummy = Date.now();
        $.ajax({
            url :'{{route('menu.supprimer')}}',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                $('div[id="menu_'+id+'"]').remove();
                success('Votre menu a été supprimé');
            },
            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }

    function supprimer_contenu(id_menu,id_contenu)
    {
        var dummy = Date.now();
        $.ajax({
            url :'{{route('contenu.supprimer')}}',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id_menu:id_menu, id_contenu:id_contenu},
            success : function(code_html, statut){
                $('li[id="contenu_'+id_menu+'_'+id_contenu+'"]').remove();
                success('Votre contenu a été supprimé');
            },
            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }


    $('input[type="checkbox"][name="categorie"]').change(function() {
        var dummy = Date.now();
        const categorie = $(this).val();
        if(this.checked) {
            $.ajax({
                url :'{{route('afficher_cat')}}',
                type : 'GET',
                dataType : 'html',
                data : {dummy:dummy, categorie:categorie},
                success : function(code_html, statut){
                    $('#aff_'+categorie).html(code_html);
                },
                error : function(resultat, statut, erreur){
                    alert('Erreur avec la requete Ajax');
                },
            });
        }
        else
        {
            $('#aff_'+categorie).empty();
        }
    });


    function ajouter_promo(id)
    {
        $('#id').val(id);
    }
</script>
@endsection
