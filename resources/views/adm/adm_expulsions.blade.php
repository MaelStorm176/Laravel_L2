@extends('layouts.adm')
@section('titre')
    EXPULSIONS<span class="fas fa-user-alt-slash mt-1 ml-1"></span>
@endsection
@section('contenu')
<div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Expulser un utilisateur<span class="fas fa-ban mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form class="mb-0" method="post" action="{{route('adm_explusion_ajout')}}">
                            @csrf
                            <section class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="mail">Adresse Mail</label>
                                    <input type="mail" id="mail" name="mail" class="form-control" required>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="date">Date fin</label>
                                    <input type="date" id="date" name="date" class="form-control" required>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary text-white w-100">EXCLURE</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Liste des explusions<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="align-middle" scope="col">#</th>
                                    <th class="align-middle" scope="col">PSEUDONYME</th>
                                    <th class="align-middle" scope="col">MAIL</th>
                                    <th class="align-middle" scope="col">DATE FIN</th>
                                    <th class="align-middle" scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key)
                                    <tr id="user_{{$key->id}}">
                                        <td class="align-middle">{{$key->id}}</td>
                                        <td class="align-middle">{{$key->username}}</td>
                                        <td class="align-middle">{{$key->email}}</td>
                                        <td class="align-middle">{{$key->ban}}</td>
                                        <td class="align-middle">
                                            <span class="fas fa-edit btn p-0"></span>
                                            <span onclick="supprimer({{$key->id}})" class="fas fa-trash-alt btn p-0"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                            {{ $users->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
<script>
    function supprimer(id){
        var dummy = Date.now();
            $.ajax({
            url : '{{route('adm_explusion_supprimer')}}',
            type : "GET",
            dataType : 'html',
            data : {dummy:dummy, id:id},
            success : function(code_html, statut){
            $('tr[id="user_'+id+'"]').remove();
            },
            error : function(resultat, statut, erreur){
            alert('Erreur avec la requete Ajax');
            },
        });
    }
</script>
    @endsection
