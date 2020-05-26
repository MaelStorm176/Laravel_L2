@extends('layouts.adm')
@section('titre')
    INGREDIENTS<span class="fas fa-drumstick-bite mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
            <button type="button" onclick="ajouter()" class="btn btn-outline-primary w-100 mb-3" data-toggle="modal" data-target="#putain">
                                    Ajouter un ingrédient
                                </button>
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Liste des ingrédients<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($ingredients as $value)
                                    <tr id="{{$value->id}}">
                                        <td class="align-middle">{{ $value->nom_i }}</td>
                                        <td class="align-middle"><img style="margin-left: 2em" src="../{{$value->image}}"width="150px"></td>
                                        <td class="align-middle">{{ $value->prix_i }}€</td>
                                            <td class="align-middle"><button type="button" onclick="modifier({{$value->id}})" class="btn fas fa-edit" data-toggle="modal" data-target="#putain">
                                                 
                                                </button>
                                                <button type="button" onclick="supprimer({{$value->id}})" class="btn fas fa-trash-alt">
                                                   
                                                </button>
                                            </td>
                                    </tr>
                                  
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" style="z-index:200000;" id="putain" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
            url :'../craft_afficher_form',
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
            url :'../craft_supprimer_ingredient',
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