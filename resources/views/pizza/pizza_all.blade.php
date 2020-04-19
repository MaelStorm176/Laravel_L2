@extends('layouts.app')
<head>
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/pizza.css" rel="stylesheet">

</head>
@section('content')
    @include('pizza.pizza_modal')
    <div id="pizza-container" class="pizza-container">
    @foreach($pizza as $key)
        @if($key->statut == 'Disponible')
        <div class="produit hvr-grow" id="{{$key->id}}">
            @auth
                @if(Auth::user()->id==1 && Auth::user()->username=="admin")
                    <div style="z-index: 6; position: absolute;">
                        <i class="fas fa-edit" onclick="modifier({{$key->id}})" data-toggle="modal" data-target="#exampleModalCenter"></i> <br/> <br/>
                        <i class="fas fa-trash" onclick="supprimer({{$key->id}})" style="z-index: 6; position: absolute;"></i>
                    </div>
                @endif
            @endauth
            <img src="{{$key->photo}}" class="img-pizza">
            <h3><span>{{$key->nom}}</span></h3>
            <p style="width: 50%;">{{$key->description}}</p>
            <a href="pizza_all/{{$key->nom}}" class="btn btn-outline-primary">Voir le détail</a>
        </div>
        @else
        <div class="produit" id="{{$key->id}}" style="cursor: not-allowed; filter: opacity(50%);-webkit-filter: opacity(50%);">
            @auth
                @if(Auth::user()->id==1 && Auth::user()->username=="admin")
                    <div style="z-index: 6; position: absolute;">
                        <i class="fas fa-edit" onclick="modifier({{$key->id}})" data-toggle="modal" data-target="#exampleModalCenter"></i> <br/> <br/>
                        <i class="fas fa-trash" onclick="supprimer({{$key->id}})" style="z-index: 6; position: absolute;"></i>
                    </div>
                @endif
            @endauth
            <img src="{{$key->photo}}" class="img-pizza">
            <h3><span>{{$key->nom}}</span></h3>
            <p>{{$key->description}}</p>
            <a class="btn btn-outline-primary" style="cursor: not-allowed;">Indisponible</a>

        </div>
        @endif
    @endforeach
    </div>


    <!-- TOASTS -->
    <div class="toast fixed-bottom" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="false">
        <div class="toast-header">
            <!-- <img src="..." class="rounded mr-2" alt="..."> !-->
            <strong class="mr-auto">Information</strong>
            <small class="text-muted"><1 min</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" id="input-toast">
        </div>
    </div>

    <!-- RECEPTION DE MESSAGE -->
    @if(session()->get('message'))
        <input type="hidden" id="message" value="{{session()->get('message')}}">
        <script>
            window.onload=function()   {
                const message = $('#message').val();
                $('#input-toast').text(message);
                $('.toast').toast('show').slideDown();
            }
        </script>
    @endif
@endsection
