@extends('layouts.adm')
@section('titre')
    NEWSLETTER<span class="fas fa-envelope-square mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Envoyer un mail<span class="fas fa-share mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form class="mb-0" method="post" action="{{route('adm_envoi_mail')}}">
                            @csrf
                            <div class="form-group">
                                <label for="objet">Objet</label>
                                <input type="text" id="objet" name="objet" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="contenu">Contenu</label>
                                <textarea class="form-control" id="contenu" name="contenu" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">ENVOYER</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Liste des inscrits<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Adresse Mail</th>
                                    <th scope="col">Date inscription</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($newsletters as $key)
                                    <tr id="{{$key->id}}">
                                        <td class="align-middle">{{$key->id}}</td>
                                        <td class="align-middle">{{$key->email}}</td>
                                        <td class="align-middle">{{$key->created_at}}</td>
                                        <td><span class="fas fa-trash-alt btn" onclick="supprimer({{$key->id}})"></span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            {{ $newsletters->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<script>
    function supprimer(id) {
        var dummy = Date.now();
        $.ajax({
            url : 'newsletter_supprimer',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
                $('tr[id="'+id+'"]').remove();
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }
</script>