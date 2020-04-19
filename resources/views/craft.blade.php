@extends('layouts.app')
@section('content')

    <div class="container" style="padding-bottom: 3em">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Craft une pizza</div>
                    @auth
                        @if(Auth::user()->id==1 && Auth::user()->username=="admin")
                            <button type="button" onclick="ajouter()" class="btn btn-outline-primary" data-toggle="modal" data-target="#putain">
                                Ajouter un ingrédient
                            </button>
                        @endif

                        <!-- Modal -->
                        <div class="modal fade" id="putain" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Ajouter une pizza</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('ajouter_ingredient') }}" id="formu" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row" >
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Image</label>
                                                <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                    <input type="file" name="image_i" id="image_i"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row" >
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Nom ingrédient</label>
                                                <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                    <input type="text" name="nom_i" id="nom_i" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row" >
                                                <label for="staticEmail" class="col-sm-3 col-form-label">Prix</label>
                                                <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                    <input type="text" name="prix_i" id="prix_i" class="form-control">
                                                </div>
                                            </div>
                                                <input type="hidden" id="edit" name="edit" value="">
                                            <div class="col-md-6">
                                                <button type="submit"  class="btn btn-success">Valider</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table style="vertical-align: baseline; text-align: center" >
                            <thead>
                            <tr>
                                <th scope="col">Ingrédient</th>
                                <th scope="col">Ajouter</th>
                                <th scope="col">Prix</th>
                                @if(Auth::user()->id==1 && auth::user()->username=="admin")
                                    <th scope="col">Modifier</th>
                                    <th scope="col">Supprimer</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            <form action="{{route('craft.ajouter')}}" method="post">
                            @csrf
                            <!-- {{$var=1}}-->
                        @foreach ($ingredients as $value)
                            <tr id="{{$value->id}}">
                                <td>{{ $value->nom_i }}<img style="margin-left: 2em" src="{{$value->image}}"width="150px"></td>
                                <td><div class="form-check form-check-inline">
                                        <input class="form-check-input" name="ingredient_{{$var}}" type="checkbox" id="inlineCheckbox1" value="{{$value->nom_i}}">
                                    </div></td>
                                <td>{{ $value->prix_i }}€</td>
                                @if(Auth::user()->id==1 && Auth::user()->username=="admin")


                                    <td><button type="button" onclick="modifier({{$value->id}})" class="btn btn-outline-primary" data-toggle="modal" data-target="#putain">
                                        Modifier
                                    </button></td>
                                    <td><button type="button" onclick="supprimer({{$value->id}})" class="btn btn-outline-primary">
                                            Supprimer
                                        </button></td>

                                @endif
                            </tr>
                            <!--  {{$var++}}-->
                        @endforeach
                            <tr>
                                <td><button type="submit" class="btn btn-primary">Valider</button></td>
                            </tr>
                            </form>
                            </tbody>
                        </table>
                            <!-- -->
                    @endauth
                    @guest
                    Vous devez être connecté
                    @endguest
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    //Vide le formulaire afin d'ajouter une pizza
    function ajouter(){
        $('#exampleModalLongTitle').html('Ajouter un ingrédient');
        $('#formu').prop('action','{{route('ajouter_ingredient')}}');
        $('#image_i').val('');
        $('#nom_i').val('');
        $('#prix_i').val('');
    }
    //Rempli le formulaire afin de modifier la pizza selectionnée
    function modifier(id) {
        $('#exampleModalLongTitle').html('Modifier un ingrédient');
        $('#formu').prop('action','{{route('craft_modifier')}}');
        $('#nom_i').val('');
        $('#edit').val(id);
        $('#image_i').val('');
        $('#prix_i').val('');
        var dummy = Date.now();
        $.ajax({
            url :'craft_afficher_form',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                var dataretour = code_html.split('|');
                $('#nom_i').val(dataretour[0]);
                $('#prix_i').val(dataretour[1]);
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }

    function supprimer(id){
        var dummy = Date.now();
        $.ajax({
            url :'supprimer_ingredient',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                $('tr[id="'+id+'"]').remove();
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }
</script>


