@extends('layouts.adm')
@section('titre')
    AVIS<span class="fas fa-comment mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info">
                    <div class="card-header bg-info text-white">Supprimer un avis<span class="fas fa-comment-slash mt-1 float-right"></span></div>
                    <form class="w-100 bg-danger mb-0" method="GET" action="{{route('adm_avis')}}">
                        <select class="form-control rounded-0 bg-danger text-white border-danger" name="choix" onchange="this.form.submit();">
                            <option>Trier les commentaires</option>
                            <option value="recent">Les plus recent</option>
                            <option value="mieux">Les mieux notés</option>
                            <option value="moins">Les moins bien notés</option>
                        </select>
                    </form>
                    <div class="card-body pb-0">
                        <div class="list-group mb-3">
                            @foreach($commentaires as $key)
                                <div id="{{$key->id}}" class="list-group-item list-group-item-action list-group-item-primary p-0 mb-3 rounded border-secondary border">
                                    <div class="w-100 bg-white d-flex justify-content-between px-4 py-3 rounded-top">
                                        <h4 class="mb-0">{{$key->username}}</h4>
                                        <div>
                                            @if($key->note <= 2)
                                                <span class="badge badge-danger px-3 py-2 rounded-circle">{{$key->note}}</span>
                                            @else
                                                @if($key->note == 3)
                                                    <span class="badge badge-warning px-3 py-2 rounded-circle text-white">{{$key->note}}</span>
                                                @else
                                                    <span class="badge badge-success px-3 py-2 rounded-circle">{{$key->note}}</span>
                                                @endif
                                            @endif
                                            <button type="button" class="btn btn-primary" onclick="supprimer_avis({{$key->id}})"><span class="fas fa-trash-alt"></span></button>
                                        </div>
                                    </div>
                                    <div class="px-4 pt-2">
                                        <p class="mb-1 text-justify">{{$key->commentaire}}</p>
                                        <hr />
                                        <div class="w-100 text-center mb-2">
                                            <small>{{$key->created_at}}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <nav aria-label="Page navigation example">
                            {{ $commentaires->links() }}
                        </nav>
                    </div>
                </div>
                <div class="p-4 w-100"></div>
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
