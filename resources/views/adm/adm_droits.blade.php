@extends('layouts.adm')
@section('titre')
    DROITS<span class="fas fa-user-plus mt-1 ml-1"></span>
@endsection
@section('contenu')
<div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Ajouter des droits à un nouvel utilisateur<span class="fas fa-plus-circle mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Adresse Mail">
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
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="align-middle" scope="col">MAIL</th>
                                    <th class="align-middle" scope="col">COMMANDES</th>
                                    <th class="align-middle" scope="col">CARTE</th>
                                    <th class="align-middle" scope="col">PLANNING</th>
                                    <th class="align-middle" scope="col">PARAMETRES SITE</th>
                                    <th class="align-middle" scope="col">UTISATEURS</th>
                                    <th class="align-middle" scope="col">UPGRADE</th>
                                    <th class="align-middle" scope="col">MODERATEUR</th>
                                    <th class="align-middle" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">email0@exemple.fr</td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">email0@exemple.fr</td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">email0@exemple.fr</td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><input type="checkbox"></td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection