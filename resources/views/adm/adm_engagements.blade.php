@extends('layouts.adm')
@section('titre')
    ENGAGEMENTS<span class="fas fa-object-group mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
            <div class="row row-cols-1 row-cols-md-3">
                @foreach($engagements as $key)
                    <div class="col mb-4">
                        <div class="card">
                            <div class="row justify-content-center">
                                <div class="col-8">
                                    <img src="../{{$key->photo}}" class="card-img-top rounded-circle pt-3 w-100" style="height:10rem;" alt="">
                                </div>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{$key->titre}}</h5>
                                <p class="card-text text-justify">{{$key->description_courte}}</p>
                            </div>
                            <div class="card-footer">
                                <form method="GET" action="{{route('supprimer_engagement')}}">
                                    <section class="row">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-primary w-100" onclick="engagements({{$key->id}})" data-toggle="modal" data-target="#modal_modif">MODIFIER</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-danger w-100" name="id" value="{{$key->id}}">SUPPRIMER</button>
                                        </div>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                    <div class="col mb-4">
                        <div class="card bg-info h-100 text-center text-white" type="button" data-toggle="modal" data-target="#ajoutModalCenterCode">
                            <div class="m-auto w-100 bg-secondary p-4">
                                <span class="fas fa-plus-circle "></span><br>
                                AJOUTER UN ELEMENT
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<!-- MODAL AJOUT ENGAGEMENT -->
<div class="modal fade" style="z-index:200000;" id="ajoutModalCenterCode" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLongTitleCode">Ajouter un engagement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0" method="post" action="{{route('ajout_engagement')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" id="titre" name="titre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description_courte">Description courte</label>
                        <textarea type="text" id="description_courte" name="description_courte" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" id="upload" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL MODIF ENGAGEMENT -->
<div class="modal fade" style="z-index:200000;" id="modal_modif" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLongTitleCode">Modifier un engagement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="mb-0" method="post" action="{{route('modif_engagement')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="engaInput" id="engaInput">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titreM">Titre</label>
                        <input type="text" id="titreM" name="titreM" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="description_courteM">Description courte</label>
                        <textarea type="text" id="description_courteM" name="description_courteM" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit"  class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function engagements(id){
        var dummy = Date.now();
        $.ajax({
            url :'enga_afficher_form',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                var dataretour = code_html.split('_|');
                $('#engaInput').val(id);
                $('#titreM').val(dataretour[0]);
                $('#description_courteM').val(dataretour[1]);
            },
            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }
</script>