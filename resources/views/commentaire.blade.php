@extends('layouts.base2')
@section('titre')
    Ajouter un commentaire
@endsection 
@section('contenu')
    <form class="mb-0" action="{{route('ajout_commentaire')}}" method="POST">
        @csrf
        <div class="modal-body">
            <section class="row">
                <div class="col-lg-12 form-group">
                    <label for="email">Adresse Mail</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="col-lg-12 form-group">
                    <label for="commentaire">Entrer votre commentaire</label>
                    <textarea class="form-control" maxlength="100" id="commentaire" name="comm" required></textarea>
                </div>
                <span id="erreur" class="col-lg-12 invalid-feedback" role="alert" style="display: none;">
                    <strong id="message-erreur"></strong>
                </span>
                <input type="hidden" id="value" name="value">
                <div class="col-lg-6 offset-lg-3 badge badge-secondary p-3 rounded-circle w-100">
                    <section class="row">
                        <div id="star1" class="col-2 offset-1">
                            <span class="fas fa-star text-info" onmouseover="star_hover(1)" onclick="star(1)"></span>
                        </div>
                        <div id="star2" class="col-2">
                            <span class="fas fa-star text-info" onmouseover="star_hover(2)" onclick="star(2)"></span>
                        </div>
                        <div id="star3" class="col-2">
                            <span class="fas fa-star text-info" onmouseover="star_hover(3)" onclick="star(3)"></span>
                        </div>
                        <div id="star4" class="col-2">
                            <span class="fas fa-star text-info" onmouseover="star_hover(4)" onclick="star(4)"></span>
                        </div>
                        <div id="star5" class="col-2">
                            <span class="fas fa-star text-info" onmouseover="star_hover(5)" onclick="star(5)"></span>
                        </div>
                    </section>
                </div>
            </section>
        </div>
        <div class="modal-footer">
            <a href="{{route('avis')}}" class="btn btn-secondary">Retour</a>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
@endsection
<script>
    function star_hover(value)
    {
        for(i=1; i<=value; i++){
            $('#star'+i).html('<span class="fas fa-star text-warning" onmouseout="star_hover_end('+i+')" onclick="star('+i+')"></span>');
        }
    }

    function star_hover_end(value)
    {
        for(i=1; i<=value; i++){
            $('#star'+i).html('<span class="fas fa-star text-info" onmouseover="star_hover('+i+')" onclick="star('+i+')"></span>');
        }
    }

    function star(value)
    {
        for(i=1; i<=value; i++){
            $('#star'+i).html('<span class="fas fa-star text-warning" onclick="star('+i+')"></span>');
        }

        for(i=value+1; i<=5; i++){
            $('#star'+i).html('<span class="fas fa-star text-info" onclick="star('+i+')"></span>');
        }
        
        $('#value').val(value);
    }
</script>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100%;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .rating {
            direction: rtl;
        }
        .rating  {
            color: #aaFFaa;
            font-size: 3em;
            transition: color .4s;
        }
        .rating a:hover,
        .rating a:focus,
        .rating a:hover ~ a,
        .rating a:focus ~ a {
            color: orange;
            cursor: pointer;
        }
    </style>
</head>
@section('content')

    <div class="flex-center position-ref full-height ">
        <div class="content" id="content">
            @guest
                <a class="btn btn-outline-primary" href="{{ route('login') }}">Connectez vous pour poster un commentaire !</a>
            @endguest

            @auth
                <div>
                    <form action="{{route('ajout_commentaire')}}" method="GET">
                        <small id="emailHelp" class="form-text text-muted">Nous ne communiquerons jamais vos informations(c'est fo)</small>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre E-mail"> <br/>
                        <textarea class="form-control" maxlength="100" placeholder="Entrez votre commentaire" id="commentaire" name="comm"></textarea>
                        <span id="erreur" class="invalid-feedback" role="alert" style="display: none;">
                        <strong id="message-erreur"></strong>
                        </span>
                        <br>

                        <div>
                            <input  type="radio" name="value" value="1">1
                            <input  type="radio" name="value" value="2">2
                            <input  type="radio" name="value" value="3">3
                            <input  type="radio" name="value" value="4">4
                            <input  type="radio" name="value" value="5">5
                        </div>
                        <br>
                        <button type="submit">valider</button>
                    </form>
                    <br>
                </div>
            @endauth
            <a href="{{route('clear_db')}}" class="btn btn-primary">Nettoyer la base</a>

            <br>
            <br>
            <br>
            <h1> Dernier commentaire </h1>
            <div id="affichage_comm">
            </div>
            <br>
            <br>
            <br>
            <a href="avis" class="btn btn-outline-primary">Retourner à la page des avis</a>

        </div>
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
</html>

