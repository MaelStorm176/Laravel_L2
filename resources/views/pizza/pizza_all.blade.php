@extends('layouts.app')
<head>
    <link href="css/pizza.css" rel="stylesheet">
</head>
@section('content')
    @include('pizza.pizza_modal')
    <div id="pizza-container" class="pizza-container">
    @foreach($pizza as $key)
        @if($key->statut == 'Disponible')
        <div class="produit hvr-grow" id="{{$key->id}}">
            @auth
                @if(Auth::user()->role=='admin')
                    <div style="z-index: 6; position: absolute;">
                        <button type="button" class="btn btn-amber"><i class="fas fa-edit" onclick="modifier({{$key->id}})" data-toggle="modal" data-target="#exampleModalCenter"></i></button> <br/> <br/>
                        <button type="button" class="btn btn-amber"><i class="fas fa-trash" onclick="supprimer({{$key->id}})" style="z-index: 6; position: absolute;"></i></button>
                    </div>
                @endif
            @endauth
            <img src="{{$key->photo}}" class="img-pizza">
            <h3><span>{{$key->nom}}</span></h3>
            <p style="width: 50%;">{{$key->description_courte}}</p>
            <a href="pizza_all/{{$key->nom}}" class="btn btn-outline-primary">Voir le détail</a>
        </div>
        @else
        <div class="produit" id="{{$key->id}}" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);">
            @auth
                @if(Auth::user()->role=='admin')
                    <div style="z-index: 6; position: absolute;">
                        <button class="btn btn-amber"><i class="fas fa-edit" onclick="modifier({{$key->id}})" data-toggle="modal" data-target="#exampleModalCenter"></i></button> <br/> <br/>
                        <button class="btn btn-amber"><i class="fas fa-trash" onclick="supprimer({{$key->id}})" style="z-index: 6; position: absolute;"></i></button>
                    </div>
                @endif
            @endauth
            <img src="{{$key->photo}}" class="img-pizza">
            <h3><span>{{$key->nom}}</span></h3>
            <p>{{$key->description_courte}}</p>
            <a class="btn btn-outline-primary" style="cursor: not-allowed;">Indisponible</a>
        </div>
        @endif
    @endforeach
    </div>
    @include('toast')
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
                $('#categorie').val(dataretour[2]);
                $('#description_courte').val(dataretour[3]);
                $('#description_longue').val(dataretour[4]);
                $('#prix_p').val(dataretour[5]);
                $('#pet-select').val(dataretour[6]);
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
