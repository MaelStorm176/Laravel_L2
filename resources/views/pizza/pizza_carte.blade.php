@extends('layouts.base')
@section('content')
    @include('pizza.pizza_modal')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card bg-dark mb-3 p-3">
                    <div class="container">
                        <section class="row justify-content-center">
                            <div class="col-lg-2 text-center">
                                <button class="btn btn-primary text-white w-100" type="button" data-toggle="collapse" data-target="#menusCollapse" aria-expanded="true" aria-controls="menusCollapse">
                                    Nos Menus
                                </button>
                            </div>
                            <div class="col-lg-2 text-center">
                                <button class="btn btn-primary text-white w-100 collapsed" type="button" data-toggle="collapse" data-target="#entreesCollapse" aria-expanded="false" aria-controls="entreesCollapse">
                                    Nos Entrées
                                </button>
                            </div>
                            <div class="col-lg-2 text-center">
                                <button class="btn btn-primary text-white w-100 collapsed" type="button" data-toggle="collapse" data-target="#platsCollapse" aria-expanded="false" aria-controls="platsCollapse">
                                    Nos Plats
                                </button>
                            </div>
                            <div class="col-lg-2 text-center">
                                <button class="btn btn-primary text-white w-100 collapsed" type="button" data-toggle="collapse" data-target="#dessertsCollapse" aria-expanded="false" aria-controls="dessertsCollapse">
                                    Nos Desserts
                                </button>
                            </div>
                            <div class="col-lg-2 text-center">
                                <button class="btn btn-primary text-white w-100 collapsed" type="button" data-toggle="collapse" data-target="#boissonsCollapse" aria-expanded="false" aria-controls="boissonsCollapse">
                                    Nos Boissons
                                </button>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="accordion" id="accordionEx">
                    <!-- MENUS COLLAPSE -->
                    <div class="collapse show" id="menusCollapse" data-parent="#accordionEx">
                        <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                            <h5 class="mb-0">NOS MENUS</h5>
                        </div>
                    </div>
                    <!-- ENTREES COLLAPSE -->
                    <div class="collapse" id="entreesCollapse" data-parent="#accordionEx">
                        <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                            <h5 class="mb-0">NOS ENTREES</h5>
                        </div>
                    </div>
                    <!-- PLATS COLLAPSE -->
                    <div class="collapse" id="platsCollapse" data-parent="#accordionEx">
                        <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                            <h5 class="mb-0">NOS PLATS</h5>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2">
                            @foreach($pizza as $key)
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
                                                            <a type="button"  href="pizza_all/{{$key->nom}}" class="col-6 btn btn-primary navbar-btn align-center">Voir le détail</a>
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
                                                        <p class="card-text text-justify">(Description/Ingrédients) {{$key->description_courte}}</p>
                                                        <div class="row justify-content-center">
                                                            <a class="btn btn-outline-primary" style="cursor: not-allowed;">Indisponible</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!-- DESSERTS COLLAPSE -->
                    <div class="collapse" id="dessertsCollapse" data-parent="#accordionEx">
                        <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                            <h5 class="mb-0">NOS DESSERTS</h5>
                        </div>
                    </div>
                    <!-- BOISSONS COLLAPSE -->
                    <div class="collapse" id="boissonsCollapse" data-parent="#accordionEx">
                        <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                            <h5 class="mb-0">NOS BOISSONS</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
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
        $('#code').val('');
        $('#remise').val('');
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
    $('.collapse').collapse();
</script>
