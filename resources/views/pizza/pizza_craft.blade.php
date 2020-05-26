@extends('layouts.base')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card border-one mb-3">
                    <div class="card-header bg-one text-one">Créer votre pizza</div>
                    <div class="card-body">
                        @auth
                    
                            <form action="{{route('craft_ajouter')}}" class="mb-0" method="post">
                                @csrf
                                <table class="table table-hover table-bordered mb-3 text-center">
                                <thead class="bg-tab text-tab">
                                    <tr>
                                        <th class="align-middle" scope="col">Ingrédient</th>
                                        <th class="align-middle" scope="col">Image</th>
                                        <th class="align-middle" scope="col">Prix</th>
                                        <th class="align-middle" scope="col">Ajouter</th>
                                    </tr>
                                </thead>          
                                <tbody>
                                <!-- {{$var=1}}-->
                                @foreach ($ingredients as $value)
                                    <tr id="{{$value->id}}">
                                        <td class="align-middle">{{ $value->nom_i }}</td>
                                        <td class="align-middle"><img style="margin-left: 2em" src="{{$value->image}}"width="150px"></td>
                                        <td class="align-middle">{{ $value->prix_i }}€</td>
                                        <td class="align-middle"><div class="form-check form-check-inline">
                                                <input class="form-check-input" name="ingredient_{{$value->id}}" type="checkbox" id="inlineCheckbox1" value="{{$value->nom_i}}">
                                                <input class="form-check-input" name="prix_recup_{{$value->id}}" type="hidden" id="inlineCheckbox1" value="{{$value->prix_i}}">
                                            </div></td>
                                        
                                       </tr>
                                    <!--  {{$var++}}-->
                                @endforeach

                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-one w-100">Valider</button>
                            </form>
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
                                        <form action="{{ route('craft_ajouter_ingredient') }}" id="formu" method="POST" enctype="multipart/form-data">
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
<script>
    //Vide le formulaire afin d'ajouter une pizza
    function ajouter(){
        $('#exampleModalLongTitle').html('Ajouter un ingrédient');
        $('#formu').prop('action','{{route('craft_ajouter_ingredient')}}');
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
            url :'craft_supprimer_ingredient',
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


