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
                        <form>
                            <section class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="nomPizzeria">Nom du restaurant</label>
                                    <input type="text" id="nomPizerria" class="form-control">
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="lienSite">Lien du site</label>
                                    <input type="text" id="lienSite" class="form-control">
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
                    <div class="card-header bg-info text-white">Téléphonie<span class="fas fa-phone mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form>
                            <label for="num">Numéro de téléphone</label>
                            <input type="phone" id="num" class="form-control mb-4">
                            <button type="submit" class="btn btn-primary w-100">ENREGISTRER</button>
                        </form>
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
                    <div class="card-header bg-info text-white">Adresse du restaurant<span class="fas fa-map-marked-alt mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form>
                            <section class="row">
                                <div class="col-lg-12">
                                    <label for="ad">Adresse</label>
                                    <input type="text" id="ad" class="form-control mb-4">
                                </div>
                                <div class="col-lg-6">
                                    <label for="ad">Code Postal</label>
                                    <input type="text" id="ad" class="form-control mb-4">
                                </div>
                                <div class="col-lg-6">
                                    <label for="ad">Ville</label>
                                    <input type="text" id="ad" class="form-control mb-4">
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary w-100">ENREGISTRER</button>
                                </div>
                            </section>
                        </form>
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