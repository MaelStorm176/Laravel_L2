@extends('layouts.base')
@section('content')
    @include('pizza.pizza_modal')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card bg-two mb-3 p-3">
                    <div class="container">
                        <section class="row justify-content-center">
                            @foreach($categorie as $cat)
                                <div class="col-lg-2 text-center">
                                    <button class="btn btn-one w-100" type="button" data-toggle="collapse" data-target="#{{$cat->nom}}Collapse" aria-expanded="true" aria-controls="{{$cat->nom}}Collapse">
                                        Nos {{$cat->nom}}
                                    </button>
                                </div>
                            @endforeach
                            @if(!Empty($menu))
                                <div class="col-lg-2 text-center">
                                    <button class="btn btn-one w-100" type="button" data-toggle="collapse" data-target="#menu_Collapse" aria-expanded="true" aria-controls="menu_Collapse">
                                        Nos menus
                                    </button>
                                </div>
                            @endif
                        </section>
                    </div>
                </div>
                <!-- ARTICLES (Pizzas, boissons, etc...) -->
                <div class="accordion" id="accordionEx">
                    @foreach($categorie as $cat)
                        <div class="collapse" id="{{$cat->nom}}Collapse" data-parent="#accordionEx">
                            <div class="card bg-one text-one text-center p-3 font-weight-bold font-italic mb-3">
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
                                                            @auth
                                                                @if(Auth::user()->role=='admin')
                                                                    <div style="z-index: 6; position: absolute;">
                                                                        <button type="button" class="btn btn-primary" onclick="modifier({{$key->id}})" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-edit"></i></button> <br/> <br/>
                                                                        <button type="button" class="btn btn-primary" onclick="supprimer({{$key->id}})"><i class="fas fa-trash"></i></button>
                                                                    </div>
                                                                @endif
                                                            @endauth
                                                            <img src="{{$key->photo}}" class="rounded-left" style="width:150px; height:150px;">
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
                                                                <div class="row justify-content-center">
                                                                    <a type="button"  href="pizza_all/{{$key->nom}}" class="col-6 btn btn-one navbar-btn align-center">Voir le détail</a>
                                                                </div>
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
                                                            @auth
                                                                @if(Auth::user()->role=='admin')
                                                                    <div style="z-index: 6; position: absolute;">
                                                                        <button type="button" class="btn btn-primary" onclick="modifier({{$key->id}})" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-edit"></i></button> <br/> <br/>
                                                                        <button type="button" class="btn btn-primary" onclick="supprimer({{$key->id}})"><i class="fas fa-trash"></i></button>
                                                                    </div>
                                                                @endif
                                                            @endauth
                                                            <img src="{{$key->photo}}" class="rounded-left" style="width: 150px; height: 150px;">
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
                                                                <div class="row justify-content-center">
                                                                    <a class="btn btn-outline-one" style="cursor: not-allowed;">Indisponible</a>
                                                                </div>
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
                    <!-- MENUS -->
                    <div class="collapse" id="menu_Collapse" data-parent="#accordionEx">
                        <div class="card bg-one text-one text-center p-3 font-weight-bold font-italic mb-3">
                            <h5 class="mb-0 text-uppercase">NOS MENUS</h5>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2">
                            @foreach($menu as $item)
                                <div class="col mb-3" id="menu_{{$item->id}}">
                                    @if($item->statut == 'Indisponible')
                                        <div class="card" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);">
                                    @else
                                        <div class="card">
                                    @endif
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            @auth
                                                @if(Auth::user()->role=='admin')
                                                    <div style="z-index: 6; position: absolute;">
                                                        <button type="button" class="btn btn-primary" onclick="modifier_menu({{$item->id}})" data-toggle="modal" data-target="#MenuModal"><i class="fas fa-edit"></i></button> <br/> <br/>
                                                        <button type="button" class="btn btn-primary" onclick="supprimer_menu({{$item->id}})"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                @endif
                                            @endauth
                                            <img src="../images/menu.jpg" class="rounded-left" style="width:150px; height:150px;">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                @if($item->promo < $item->prix)
                                                    <div class="badge badge-danger p-2 float-right text-white"><del>{{$item->prix}}</del> {{$item->promo}} €</div>
                                                @else
                                                    <div class="badge badge-primary p-2 float-right text-white"> {{$item->promo}} €</div>
                                                @endif
                                                <h5 class="card-title mt-1">{{$item->nom}}</h5>
                                                <p class="card-text text-justify">{{$item->description}}</p>
                                                <div class="row justify-content-center">
                                                    @if($item->statut == 'Indisponible')
                                                        <a type="button" class="col-6 btn btn-one navbar-btn align-center">Indisponible</a>
                                                    @else
                                                        <a type="button" href="pizza_all/menu/{{$item->nom}}" class="col-6 btn btn-one navbar-btn align-center">Voir le détail</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
<script type="text/javascript">
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
    function ajoutercode(){
        $('#exampleModalLongTitleCode').html('Ajouter un code');
        $('#formucode').prop('action','{{route('code.upload')}}');
        $('#upload').html('Ajouter');
        $('#id_code').val('');
        $('#remise_label').html('Remise que le code applique sur la commande (en %)');
        $('#remise').val('');
        $('#remise').prop('placeholder',"Remise");
        $('#date_limite').show();
        $('#date_label').show();
    }

    function ajouterCate(){
        $('#exampleModalLongTitleCode').html('Ajouter une catégorie');
        $('#formucode').prop('action','{{route('categorie.upload')}}');
        $('#remise_label').html("Entrez le nom d'une catégorie (Pizzas, boissons, desserts...)");
        $('#remise').val('');
        $('#remise').prop('placeholder',"Catégorie");
        $('#id_code').val('');
        $('#date_limite').hide();
        $('#date_label').hide();
    }
    //Rempli le formulaire afin de modifier la pizza selectionnée
    function modifier(id) {
        $('#exampleModalLongTitle').html('Modifier pizza');
        $('#formu').prop('action','{{route('pizza.modifier')}}');
        $('#upload').html('Modifier');
        $('#id_pizza').val(id);
        var dummy = Date.now();
        $.ajax({
            url :'afficher_form',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                var dataretour = code_html.split('_|');
                $('#image_affiche').show();
                $('#image_base').val(dataretour[0]);
                $('#image_affiche').attr("src",dataretour[0]);
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
    function supprimer(id){
        var dummy = Date.now();
        $.ajax({
            url :'pizza.supprimer',
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


    function ajouter_menu()
    {
        $('input[type="checkbox"][name="categorie"]').change().prop('checked', false);
        $('input[type="checkbox"][name="article[]"]').prop('checked', false);
        $('#MenuModalLongTitle').html('Créer un menu');
        $('#formulaire_menu').prop('action','{{route('menu.upload')}}');
        $('#nom_m').val('');
        $('#description_m').val('');
        $('#prix_m').val('');
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
            url :'afficher_form_menu',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                var dataretour = code_html.split('_|');
                $('#nom_m').val(dataretour[0]);
                $('#description_m').val(dataretour[1]);
                $('#prix_m').val(dataretour[2]);

                for (var i=4;i<=dataretour.length;i++){
                    $('input[type="checkbox"][name="categorie"][value='+dataretour[i]+']').change().prop('checked', true);
                    i++;
                }
                setTimeout(function() {
                    for(i=3;i<=(dataretour.length-1);i++){
                        $('input[type="checkbox"][name="article[]"][value='+dataretour[i]+']').prop('checked', true);
                        i++;
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
            url :'menu.supprimer',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                $('div[id="menu_'+id+'"]').remove();
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
                url :'afficher_cat',
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
    $('.collapse').collapse();
</script>
@endsection
