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
                    <form class="w-100 bg-danger" method="GET" action="{{route('avis')}}">
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
                                <a href="#" class="list-group-item list-group-item-action list-group-item-primary">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h4 class="mb-1">{{$key->username}}</h4>
                                        <span class="badge badge-success p-2 rounded-circle shadow">{{$key->note}}</span>
                                    </div>
                                    <p class="mb-1 text-justify">{{$key->commentaire}}</p>
                                    <small>{{$key->created_at}}</small>
                                </a>
                            @endforeach
                        </div>
                        <nav aria-label="Page navigation example">
                            {{ $commentaires->links() }}
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
