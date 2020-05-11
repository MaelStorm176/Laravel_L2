@extends('layouts.app')
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Commentaire</title>

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
                            <!--
                            <a onclick="ajout_commentaire(this)" id="star5" value="5" title="Donner 5 étoiles">5</a>
                            <a onclick="ajout_commentaire(this)" id="star4" value="4" title="Donner 4 étoiles">4</a>
                            <a onclick="ajout_commentaire(this)" id="star3" value="3" title="Donner 3 étoiles">3</a>
                            <a onclick="ajout_commentaire(this)" id="star2" value="2" title="Donner 2 étoiles">2</a>
                            <a onclick="ajout_commentaire(this)" id="star1" value="1" title="Donner 1 étoile">1</a>
                            -->


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

