@extends('layouts.base')
@section('content')
    @include('pizza.pizza_modal')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">NOS PIZZAS</h5>
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

                <!--
                <div class="card bg-danger text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">NOS PLATS</h5>
                </div>
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">(Description/Ingrédients)This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-primary navbar-btn align-center">Ajouter au panier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-secondary navbar-btn align-center" disabled>Indisponible</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-primary navbar-btn align-center">Ajouter au panier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-primary navbar-btn align-center">Ajouter au panier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">NOS DESSERTS</h5>
                </div>
                <div class="row row-cols-1 row-cols-md-2">
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">(Description/Ingrédients)This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-primary navbar-btn align-center">Ajouter au panier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-secondary navbar-btn align-center" disabled>Indisponible</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-primary navbar-btn align-center">Ajouter au panier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-primary navbar-btn align-center">Ajouter au panier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-danger text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">NOS BOISSONS</h5>
                </div>
                <div class="row row-cols-1 row-cols-md-2 mb-3">
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">(Description/Ingrédients)This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-primary navbar-btn align-center">Ajouter au panier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-secondary navbar-btn align-center" disabled>Indisponible</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-primary navbar-btn align-center">Ajouter au panier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="img/pizzaCarte.jpg" class="w-100 rounded-left" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="badge badge-primary p-2 float-right text-white">10€</div>
                                        <h5 class="card-title mt-1">Article X</h5>
                                        <p class="card-text text-justify">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                        <div class="row justify-content-center">
                                            <button type="button" class="col-6 btn btn-primary navbar-btn align-center">Ajouter au panier</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                -->
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
</script>
