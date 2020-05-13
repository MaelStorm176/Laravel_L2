@extends('layouts.adm')
@section('titre')
    INFORMATIONS<span class="fas fa-info-circle mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Rechercher un Utilisateur<span class="fas fa-search mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form action="{{route('adm_informations')}}" method="post">
                            @csrf
                            <section class="row">
                                <div class="col-lg-4 mb-4">
                                    <label for="nom">Nom</label>
                                    <input type="text" name="last_name" class="form-control">
                                </div>
                                <div class="col-lg-4 mb-4">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" name="first_name" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary text-white w-100">RECHERCHER</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Liste des Utilisateurs<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="align-middle" scope="col">NOM</th>
                                    <th class="align-middle" scope="col">PRENOM</th>
                                    <th class="align-middle" scope="col">MAIL</th>
                                    <th class="align-middle" scope="col">NOM UTILISATEUR</th>
                                    <th class="align-middle" scope="col">POINTS FIDELITE</th>
                                    <th class="align-middle" scope="col">NOMBRES COMMANDES</th>
                                    <th class="align-middle" scope="col">STATUT</th>
                                    <th class="align-middle" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <?php $nb_comm = DB::table('commande')->where('user_id','=',$user->id)->count(); ?>
                                <tr>
                                    <td class="align-middle">{{$user->last_name}}</td>
                                    <td class="align-middle">{{$user->first_name}}</td>
                                    <td class="align-middle">{{$user->email}}</td>
                                    <td class="align-middle">{{$user->username}}</td>
                                    <td class="align-middle">24</td>
                                    <td class="align-middle">{{$nb_comm}}</td>
                                    <td class="align-middle">{{$user->role}}</td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
