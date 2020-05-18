@extends('layouts.adm')
@section('titre')
    GENERAL<span class="fas fa-sliders-h mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Identité<span class="fas fa-fingerprint mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form method="GET" action={{route('adm_identite')}}>
                            <section class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="nomPizzeria">Nom du restaurant</label>
                                    <input type="text" id="nomPizzerria" class="form-control">
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="lienSite">Lien du site</label>
                                    <input type="text" id="lienSite" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary w-100">ENREGISTRER</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Téléphonie<span class="fas fa-phone mt-1 float-right"></span></div>
                    <div class="card-body">
                        @foreach($telephone as $key)
                            <form method="GET" action={{route('adm_changer_numero')}}>
                                <label for="numero">Changer le numéro de téléphone</label>
                                <input type="text" name="numero" class="form-control mb-4" value="{{$key->numero}}">
                                <button type="submit" class="btn btn-primary w-100">ENREGISTRER</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Images<span class="fas fa-images mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form>
                            <section class="row">
                                <div class="col-lg-12 mb-4">
                                    <label for="banniere">Bannière</label>
                                    <input type="file" id="baniere" class="form-control">
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="logo">Logo</label>
                                    <input type="file" id="logo" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-primary w-100">ENREGISTRER</button>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Changer l'adresse du restaurant<span class="fas fa-map-marked-alt mt-1 float-right"></span></div>
                    <div class="card-body">
                        @foreach($adresse as $key)
                            <form method='GET' action={{route('adm_changer_adresse')}}>
                                <section class="row">
                                    <div class="col-lg-12">
                                        <label for="rue">Rue</label>
                                        <input type="text" name="rue" class="form-control mb-4" value="{{$key->rue}}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="code_postal">Code Postal</label>
                                        <input type="text" name="code_postal" class="form-control mb-4" value="{{$key->code_postal}}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="ville">Ville</label>
                                        <input type="text" name="ville" class="form-control mb-4" value="{{$key->ville}}">
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-primary w-100">ENREGISTRER</button>
                                    </div>
                                </section>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Couleurs<span class="fas fa-paint-roller mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead class="bg-primary text-white ">
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Valeur</th>
                                    <th scope="col">Aperçu</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="align-middle" scope="row" rowspan="2">Primaire</td>
                                    <td class="align-middle">Couleur de fond</td>
                                    <td class="align-middle">#3D9D2A</td>
                                    <td class="align-middle"><div class="w-75 p-4 mx-auto rounded-circle" style="background:#3D9D2A;"></div></td>
                                    <td class="align-middle"><span class="fas fa-edit"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Couleur de texte</td>
                                    <td class="align-middle">#FFFFFF</td>
                                    <td class="align-middle"><div class="w-75 p-4 mx-auto rounded-circle" style="background:#FFFFFF;"></div></td>
                                    <td class="align-middle"><span class="fas fa-edit"></span></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" rowspan="2">Secondaire</td>
                                    <td class="align-middle">Couleur de fond</td>
                                    <td class="align-middle">#DF2121</td>
                                    <td class="align-middle"><div class="w-75 p-4 mx-auto rounded-circle" style="background:#DF2121;"></div></td>
                                    <td class="align-middle"><span class="fas fa-edit"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Couleur de texte</td>
                                    <td class="align-middle">#FFFFFF</td>
                                    <td class="align-middle"><div class="w-75 p-4 mx-auto rounded-circle" style="background:#FFFFFF;"></div></td>
                                    <td class="align-middle"><span class="fas fa-edit"></span></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" rowspan="2">Navigation</th>
                                    <td class="align-middle">Couleur de fond</td>
                                    <td class="align-middle">#000000</td>
                                    <td class="align-middle"><div class="w-75 p-4 mx-auto rounded-circle" style="background:#000000;"></div></td>
                                    <td class="align-middle"><span class="fas fa-edit"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Couleur de texte</td>
                                    <td class="align-middle">#FFFFFF</td>
                                    <td class="align-middle"><div class="w-75 p-4 mx-auto rounded-circle" style="background:#FFFFFF;"></div></td>
                                    <td class="align-middle"><span class="fas fa-edit"></span></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" rowspan="2">Boutton</th>
                                    <td class="align-middle">Couleur de fond</td>
                                    <td class="align-middle">#4F62D9</td>
                                    <td class="align-middle"><div class="w-75 p-4 mx-auto rounded-circle" style="background:#4F62D9;"></div></td>
                                    <td class="align-middle"><span class="fas fa-edit"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Couleur de texte</td>
                                    <td class="align-middle">#FFFFFF</td>
                                    <td class="align-middle"><div class="w-75 p-4 mx-auto rounded-circle" style="background:#FFFFFF;"></div></td>
                                    <td class="align-middle"><span class="fas fa-edit"></span></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row">Arrière plan</th>
                                    <td class="align-middle">Couleur de fond</td>
                                    <td class="align-middle">#000000</td>
                                    <td class="align-middle"><div class="w-75 p-4 mx-auto rounded-circle" style="background:#000000;"></div></td>
                                    <td class="align-middle"><span class="fas fa-edit"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
