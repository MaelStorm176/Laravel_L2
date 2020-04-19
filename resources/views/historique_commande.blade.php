@extends('layouts.app')
@section('content')

    <div class="container" style="padding-bottom: 3em">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    @auth
                        <form action="{{route('craft')}}">
                        <button type="submit" class="btn btn-outline-primary" data-toggle="modal">
                            Craft une pizza
                        </button></form>
                        @if(Auth::user()->id==1 && Auth::user()->username=="admin")
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <div class="container">

                                    <div class="panel panel-primary">
                                        <div class="panel-body">

                                            @if ($message = Session::get('success'))
                                                <div class="alert alert-success alert-block">
                                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                                    <strong>{{ $message }}</strong>

                                                </div>
                                            <!--<img src="images/{{ Session::get('image') }}">!-->
                                            @endif

                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                    <strong>Houlala</strong> Il y a une problème avec un des champs.
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                        @endif
                                        <!-- Button trigger modal -->
                                            <button type="button"  class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModalCenter">
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
                                                            <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-group row" >
                                                                    <label for="staticEmail" class="col-sm-3 col-form-label">Insérez votre image</label>
                                                                    <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                                        <input type="file" name="image" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" >
                                                                    <label for="staticEmail" class="col-sm-3 col-form-label">Nom de votre pizza</label>
                                                                    <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                                        <input type="text" name="nom_p" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" >
                                                                    <label for="staticEmail" class="col-sm-3 col-form-label">Description de la pizza</label>
                                                                    <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                                        <input type="text" name="description_p" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" >
                                                                    <label for="staticEmail" class="col-sm-3 col-form-label">Choisissez le statut de la pizza</label>
                                                                    <div class="col-sm-5" style="margin-bottom: 1.5em">
                                                                        <select class="form-control" name="statut_p" id="pet-select">
                                                                            <option value="">--Choisissez une option--</option>
                                                                            <option value="Disponible">Disponible</option>
                                                                            <option value="Indisponible">Indisponible</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <button type="submit" class="btn btn-success">Upload</button>
                                                                </div>


                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                                    <div class="card-body" id="tag_container">
                                                        @include('presult')
                                                    </div>
                                               @else

                                                    <div class="card-body" id="tag_container">
                                                        @include('presult2')
                                                    </div>
                                                @endif
                                                @if(Auth::user()->id==1 && Auth::user()->username=="admin")
                                        </div>
                                    </div>
                                </div>
                            </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">Commandes en cours</div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Type pizza</th>
                            <th scope="col">Nom client</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Statut Paiement</th>
                            <th scope="col">Heure de la commande</th>
                            <th scope="col">Statut Préparation</th>

                        </tr>
                        </thead>
                        <tbody id="afficher_commande">

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@else
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

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
    @endauth

@endsection

<script>
    function myFunction() {
        var x = document.getElementById("myDIV");
        if (x .style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>


<script type="text/javascript">
    function charger_commande(){
        setTimeout( function(){
            // on lance une requête AJAX
            $.ajax({
                url : "afficher_commande",
                type : 'GET',
                success : function(html){
                    $('#afficher_commande').html(html); // on veut ajouter les nouveaux messages au début du bloc #messages
                }
            });

            charger_commande(); // on relance la fonction

        }, 10000); // on exécute le chargement toutes les 5 secondes
    }

    charger_commande();

    function valider(id){
        $.ajax({
            url : 'valider',
            type : 'GET',
            dataType : 'html',
            data : {id:id},
            success : function(code_html, statut){
                //$(code_html).appendTo("#commentaires"); // On passe code_html à jQuery() qui va nous créer l'arbre DOM !
                $('tr[id="'+id+'"]').remove();
                $('#input-toast').text('Merci de votre commentaire !');
                $('.toast').toast('show').slideDown();
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },

            complete : function(resultat, statut){

            }

        });
    }
</script>

