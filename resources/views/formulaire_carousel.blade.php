@foreach($carousel1 as $key)
<a type="button" id="id_boutton" class="btn btn-outline-primary" onclick="supprimer({{$key->id}})">Supprimer l'element</a>
<div class="form-group row" >
    <label for="staticEmail" class="col-sm-3 col-form-label">Image</label>
    <div class="col-sm-5" style="margin-bottom: 1.5em">
        <input type="file" name="image_carousel" id="image_carousel_{{$key->id}}"  class="form-control">
    </div>
</div>
<div class="form-group row" >
    <label for="staticEmail" class="col-sm-3 col-form-label">Titre carousel</label>
    <div class="col-sm-5" style="margin-bottom: 1.5em">
        <input type="text" name="titre_carousel" id="titre_carousel_{{$key->id}}" class="form-control">
    </div>
</div>
<div class="form-group row" >
    <label for="staticEmail" class="col-sm-3 col-form-label">Couleur titre</label>
    <div class="col-sm-5" style="margin-bottom: 1.5em">
        <input type="color" value="#DCDCDC" name="titre_couleur" id="titre_couleur_{{$key->id}}" class="form-control">
    </div>
</div>
<div class="form-group row" >
    <label for="staticEmail" class="col-sm-3 col-form-label">Texte carousel</label>
    <div class="col-sm-5" style="margin-bottom: 1.5em">
        <input type="text" name="texte_carousel" id="texte_carousel_{{$key->id}}" class="form-control">
    </div>
</div>
<div class="form-group row" >
    <label for="staticEmail" class="col-sm-3 col-form-label">Couleur texte</label>
    <div class="col-sm-5" style="margin-bottom: 1.5em">
        <input type="color" value="#DCDCDC" name="texte_couleur" id="texte_couleur_{{$key->id}}" class="form-control">
    </div>
</div>
<input type="hidden" name="id_carousel" value="{{$key->id}}">
<div class="form-group row" >
    <label for="staticEmail" class="col-sm-3 col-form-label">Couleur fond</label>
    <div class="col-sm-5" style="margin-bottom: 1.5em">
        <input type="color" value="#DCDCDC" name="fond_couleur" id="fond_couleur_{{$key->id}}" class="form-control">
    </div>
</div>
<div class="col-md-6">
    <button type="submit"  class="btn btn-success">Valider</button>
</div>
@endforeach
<script>
function supprimer(id){
    var dummy = Date.now();
    $.ajax({
        url :'../modif_carousel_supprimer',
        type : 'GET',
        dataType : 'html',
        data : {dummy:dummy, id:id},
    success : function(code_html, statut){
        $('div[id="carousel_div_'+id+'"]').remove();
        $('li[id="carousel_li_'+id+'"]').remove();
        $('option[id="optioncarousel'+id+'"]').remove();
        $('#close_modal').click();
    },

    error : function(resultat, statut, erreur){
        alert('Erreur avec la requete Ajax');
    },
    });
}
</script>
