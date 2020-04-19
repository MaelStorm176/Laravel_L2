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
               color: #aaFFaaa;
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
            <h1> Dernier commentaire </h1>
            <div id="affichage_comm">

            </div>
            @guest
                <a class="btn btn-outline-primary" href="{{ route('login') }}">Connectez vous pour poster un commentaire !</a>
            @endguest

            @auth
            <div>
                <small id="emailHelp" class="form-text text-muted">Nous ne communiquerons jamais vos informations</small>
                <input type="email" id="email" name="email" class="form-control" placeholder="Entrez votre E-mail"> <br/>
                <textarea class="form-control" maxlength="100" placeholder="Entrez votre commentaire" id="commentaire"></textarea>
                <span id="erreur" class="invalid-feedback" role="alert" style="display: none;">
                        <strong id="message-erreur"></strong>
                </span>
                <div class="rating">
                    <a onclick="ajout_commentaire(this)" id="star5" value="5" title="Donner 5 étoiles">☆</a>
                    <a onclick="ajout_commentaire(this)" id="star4" value="4" title="Donner 4 étoiles">☆</a>
                    <a onclick="ajout_commentaire(this)" id="star3" value="3" title="Donner 3 étoiles">☆</a>
                    <a onclick="ajout_commentaire(this)" id="star2" value="2" title="Donner 2 étoiles">☆</a>
                    <a onclick="ajout_commentaire(this)" id="star1" value="1" title="Donner 1 étoile">☆</a>
                </div>
            </div>
            @endauth
        <a href="{{route('clear_db')}}" class="btn btn-primary">Nettoyer la base</a>
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
<script>

function charger(){
    setTimeout( function(){
        // on lance une requête AJAX
        $.ajax({
            url : "afficher_comm",
            type : 'GET',
            success : function(html){
                $('#affichage_comm').html(html); // on veut ajouter les nouveaux messages au début du bloc #messages
            }
        });

        charger(); // on relance la fonction

    }, 5000); // on exécute le chargement toutes les 5 secondes
}

charger();


function ajout_commentaire(valeur){
    var value = $(valeur).attr('value');
    var email = $('#email').val();
    var commentaire = $('#commentaire').val();
    $.ajax({
       url : 'ajout_commentaire',
       type : 'GET',
       dataType : 'html',
       data : {value:value, email:email, comm:commentaire},
       success : function(code_html, statut){
           //$(code_html).appendTo("#commentaires"); // On passe code_html à jQuery() qui va nous créer l'arbre DOM !
           if (code_html){
               $('#erreur').show();
               $('#message-erreur').html(code_html);
           }
           else {
               $('#email').val('');
               $('#commentaire').val('');
               $('#input-toast').text('Merci de votre commentaire !');
               $('.toast').toast('show').slideDown();
           }
       },

       error : function(resultat, statut, erreur){
         alert('Erreur avec la requete Ajax');
       },

       complete : function(resultat, statut){

       }

    });
}
</script>
