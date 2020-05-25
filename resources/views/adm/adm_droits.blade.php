@extends('layouts.adm')
@section('titre')
    DROITS<span class="fas fa-user-plus mt-1 ml-1"></span>
@endsection
@section('contenu')
<?php use App\User; ?>
<div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Ajouter des droits à un nouvel utilisateur<span class="fas fa-plus-circle mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form method="post" action="{{route('adm_droits_ajouter')}}" class="mb-0">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control" name="mail" placeholder="Adresse Mail" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary waves-effect m-0 ">AJOUTER</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Liste des utilisateurs ayant des droits<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-0 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="align-middle" scope="col">#</th>
                                    <th class="align-middle" scope="col">MODERATION</th>
                                    <th class="align-middle" scope="col">RESTAURATION</th>
                                    <th class="align-middle" scope="col">PARAMETRES</th>
                                    <th class="align-middle" scope="col">UPGRADE</th>
                                    <th class="align*middle" scope="col">NEWSLETTER</th>
                                    <th class="align-middle" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($droits as $key)
                                    <tr id="{{$key->id}}">
                                        <td class="align-middle">{{User::find($key->user_id)->email}}</td>
                                        @if($key->moderation)
                                            <td class="align-middle">
                                                <input id="{{$key->id}}_moderation" type="checkbox" onclick="modifier({{$key->id}}, 'moderation')" checked>
                                            </td>
                                        @else
                                            <td class="align-middle">
                                                <input id="{{$key->id}}_moderation" onclick="modifier({{$key->id}}, 'moderation')" type="checkbox">
                                            </td>
                                        @endif
                                        @if($key->restauration)
                                            <td class="align-middle">
                                                <input id="{{$key->id}}_restauration" type="checkbox" onclick="modifier({{$key->id}}, 'restauration')" checked>
                                            </td>
                                        @else
                                            <td class="align-middle">
                                                <input id="{{$key->id}}_restauration" type="checkbox" onclick="modifier({{$key->id}}, 'restauration')">
                                            </td>
                                        @endif
                                        @if($key->parametre)
                                            <td class="align-middle">
                                                <input id="{{$key->id}}_parametre" type="checkbox" onclick="modifier({{$key->id}}, 'parametre')" checked>
                                            </td>
                                        @else
                                            <td class="align-middle">
                                                <input id="{{$key->id}}_parametre" onclick="modifier({{$key->id}}, 'parametre')" type="checkbox">
                                            </td>
                                        @endif
                                        @if($key->upgrade)
                                            <td class="align-middle">
                                                <input id="{{$key->id}}_upgrade" type="checkbox" onclick="modifier({{$key->id}}, 'upgrade')" checked>
                                            </td>
                                        @else
                                            <td class="align-middle">
                                                <input id="{{$key->id}}_upgrade" onclick="modifier({{$key->id}}, 'upgrade')" type="checkbox">
                                            </td>
                                        @endif
                                        @if($key->newsletter)
                                            <td class="align-middle">
                                                <input id="{{$key->id}}_newsletter" type="checkbox" onclick="modifier({{$key->id}}, 'newsletter')" checked>
                                            </td>
                                        @else
                                            <td class="align-middle">
                                                <input id="{{$key->id}}_newsletter" type="checkbox" onclick="modifier({{$key->id}}, 'newsletter')">
                                            </td>
                                        @endif
                                        <td class="align-middle"><span onclick="supprimer({{$key->id}})"class="fas fa-trash-alt btn"></span></td>
                                    </tr>
                                @endforeach                               
                            </tbody>
                        </table>
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
            url : 'supprimer_droits',
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

    function modifier(id, categorie) {
        var dummy = Date.now();
        $.ajax({
            url : 'droits_modifier',
            type : 'GET',
            dataType : 'html',
            data : {dummy:dummy, id:id, categorie:categorie},
            success : function(code_html, statut){
                
            },

            error : function(resultat, statut, erreur){
                alert('Erreur avec la requete Ajax');
            },
        });
    }
</script>