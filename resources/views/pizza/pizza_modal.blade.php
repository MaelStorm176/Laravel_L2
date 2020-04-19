@auth
    @if(Auth::user()->id==1 && Auth::user()->username=="admin")
    <!-- Button trigger modal -->
    <button type="button" id="bouton_ajout" onclick="ajouter()" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Ajouter une pizza
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ajouter une pizza</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('pizza.upload') }}" id="formu" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <input type="file" name="image" id="image" class="form-control">
                            </br>
                            <input type="text" name="nom_p" placeholder="Nom" id="nom_p" class="form-control">
                            </br>
                            <input type="text" name="description_p" placeholder="Description de la pizza" id="description_p" class="form-control">
                            </br>
                            <input type="number" name="prix_p" placeholder="Prix" id="prix_p" class="form-control">
                            </br>
                            <input type="hidden" name="id_pizza" id="id_pizza">
                            <select name="statut_p" id="pet-select">
                                <option value="">--Choisissez une option--</option>
                                <option value="Disponible">Disponible</option>
                                <option value="Indisponible">Indisponible</option>
                            </select>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="upload" class="btn btn-primary">Upload</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN DU MODAL -->
@endif
@endauth

<script>
    //Vide le formulaire afin d'ajouter une pizza
    function ajouter(){
        $('#exampleModalLongTitle').html('Ajouter une pizza');
        $('#formu').prop('action','{{route('pizza.upload')}}');
        $('#upload').html('Ajouter');
        $('#nom_p').val('');
        $('#description_p').val('');
        $('#prix_p').val('');
        $('#pet-select').val('');
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
                $('#image').prop('file',dataretour[0]);
                $('#nom_p').val(dataretour[1]);
                $('#description_p').val(dataretour[2]);
                $('#prix_p').val(dataretour[3]);
                $('#pet-select').val(dataretour[4]);
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
