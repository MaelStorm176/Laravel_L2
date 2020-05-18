@extends('layouts.adm')
@section('titre')
    AVIS<span class="fas fa-comment mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Supprimer un avis<span class="fas fa-comment-slash mt-1 float-right"></span></div>
                    <form class="w-100 bg-danger" method="GET" action="{{route('adm_afficher_avis')}}">
                        <select class="form-control rounded-0 bg-danger text-white border-danger" name="choix" onchange="this.form.submit();">
                            <option>Trier les commentaires</option>
                            <option value="recent">Les plus recent</option>
                            <option value="mieux">Les mieux notés</option>
                            <option value="moins">Les moins bien notés</option>
                        </select>
                    </form>
                    <div class="card-body">
                        <div class="list-group mb-3">
                            @foreach($commentaires as $key)
                                @if($key->note <= 2)
                                    <div id="{{$key->id}}" class="list-group-item list-group-item-action list-group-item-primary p-0 mb-3 rounded border border-secondary">
                                        <div class="d-flex justify-content-between bg-danger text-white text-center w-100 py-3 px-5 rounded-top">
                                            <em><h4 class="mt-2">{{$key->username}}</h4></em>
                                            <div>
                                                <div class="badge badge-secondary p-3 mr-1 rounded-circle">
                                                    @if($key->note == 1)
                                                        <span class="fas fa-star text-warning"></span>
                                                    @else
                                                        <span class="fas fa-star mr-1 text-warning"></span>
                                                        <span class="fas fa-star text-warning"></span>
                                                    @endif
                                                </div>
                                                <button type="button" class="btn btn-primary" onclick="supprimer_avis({{$key->id}})"><span class="fas fa-trash-alt"></span></button>
                                            </div>
                                        </div>
                                        <p class="mb-1 text-justify py-4 px-5">{{$key->commentaire}}</p>
                                        <div class="bg-secondary text-white text-center w-100 p-2">
                                            <small>{{$key->created_at}}</small>
                                        </div>
                                    </div>
                                @else
                                    @if($key->note == 3)
                                        <div id="{{$key->id}}" class="list-group-item list-group-item-action list-group-item-primary p-0 mb-3 rounded border border-secondary">
                                            <div class="d-flex justify-content-between bg-warning text-white text-center w-100 py-3 px-5 rounded-top">
                                                <em><h4 class="mt-2">{{$key->username}}</h4></em>
                                                <div>
                                                    <div class="badge badge-secondary p-3 mr-1 rounded-circle">
                                                        <span class="fas fa-star mr-1 text-warning"></span>
                                                        <span class="fas fa-star mr-1 text-warning"></span>
                                                        <span class="fas fa-star text-warning"></span>
                                                    </div>
                                                    <button class="btn btn-primary" onclick="supprimer_avis({{$key->id}})"><span class="fas fa-trash-alt"></span></button>
                                                </div>
                                            </div>
                                            <p class="mb-1 text-justify py-4 px-5">{{$key->commentaire}}</p>
                                            <div class="bg-secondary text-white text-center w-100 p-2">
                                                <small>{{$key->created_at}}</small>
                                            </div>
                                        </div>
                                    @else
                                        <div id="{{$key->id}}" class="list-group-item list-group-item-action list-group-item-primary p-0 mb-3 rounded border border-secondary">
                                            <div class="d-flex justify-content-between bg-success text-white text-center w-100 py-3 px-5 rounded-top">
                                                <em><h4 class="mt-2">{{$key->username}}</h4></em>
                                                <div>
                                                    <div class="badge badge-secondary p-3 mr-1 rounded-circle">
                                                        @if($key->note == 4)
                                                            <span class="fas fa-star mr-1 text-warning"></span>
                                                            <span class="fas fa-star mr-1 text-warning"></span>
                                                            <span class="fas fa-star mr-1 text-warning"></span>
                                                            <span class="fas fa-star text-warning"></span>
                                                        @else
                                                            <span class="fas fa-star mr-1 text-warning"></span>
                                                            <span class="fas fa-star mr-1 text-warning"></span>
                                                            <span class="fas fa-star mr-1 text-warning"></span>
                                                            <span class="fas fa-star mr-1 text-warning"></span>
                                                            <span class="fas fa-star text-warning"></span>
                                                        @endif
                                                    </div>
                                                    <button class="btn btn-primary" onclick="supprimer_avis({{$key->id}})"><span class="fas fa-trash-alt"></span></button>
                                                </div>
                                            </div>
                                            <p class="mb-1 text-justify py-4 px-5">{{$key->commentaire}}</p>
                                            <div class="bg-secondary text-white text-center w-100 p-2">
                                                <small>{{$key->created_at}}</small>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <nav aria-label="Page navigation example mb-0">
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
                                </li>   
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Suivant</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<script>
    function supprimer_avis(id) {
        var dummy = Date.now();
        $.ajax({
            url : 'supprimer_avis',
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