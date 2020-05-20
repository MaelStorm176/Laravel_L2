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
                        <form method="post" action="{{route('adm_identite')}}">
                            @csrf
                            <section class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="nomPizzeria">Nom du restaurant</label>
                                    <input type="text" id="nomPizerria" name="nomPizzeria" class="form-control" value="{{ config('app.name') }}" required>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="lienSite">Lien du site</label>
                                    <input type="text" id="lienSite" name="lienSite" class="form-control" value="{{ config('app.url') }}" required>
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
                        @foreach($parametres as $key)
                            <form method="post" action="{{route('adm_telephone')}}">
                                @csrf
                                <label for="num">Numéro de téléphone</label>
                                <input type="phone" id="num" name="num" class="form-control mb-4" value="{{$key->telephone}}" required>
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
                        <form method="post" action="{{route('adm_images')}}" enctype="multipart/form-data">
                            @csrf
                            <section class="row">
                                <div class="col-lg-12 mb-4">
                                    <label for="banniere">Bannière</label>
                                    <input type="file" id="baniere" name="baniere" class="form-control">
                                </div>
                                <div class="col-lg-12 mb-4">
                                    <label for="logo">Logo</label>
                                    <input type="file" id="logo" name="logo" class="form-control">
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
                    <div class="card-header bg-info text-white">Adresse du restaurant<span class="fas fa-map-marked-alt mt-1 float-right"></span></div>
                    <div class="card-body">
                        @foreach($parametres as $key)
                            <form method="post" action="{{route('adm_adresse')}}">
                                @csrf
                                <section class="row">
                                    <div class="col-lg-12">
                                        <label for="adresse">Adresse</label>
                                        <input type="text" id="adresse" name="adresse" class="form-control mb-4" value="{{$key->adresse}}" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="cp">Code Postal</label>
                                        <input type="text" id="cp" name="cp" class="form-control mb-4" value="{{$key->codePostal}}" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="ville">Ville</label>
                                        <input type="text" id="ville" name="ville" class="form-control mb-4" value="{{$key->ville}}" required>
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
                                    <td class="align-middle">{{config('couleurs.primFond')}}</td>
                                    <td class="align-middle">
                                        <div class="w-75 p-4 mx-auto rounded-circle" style="background:{{config('couleurs.primFond')}};"></div>
                                    </td>
                                    <td class="align-middle"><span class="fas fa-edit" onclick="couleurs('primFond')" data-toggle="modal" data-target="#modal_couleurs"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Couleur de texte</td>
                                    <td class="align-middle">{{config('couleurs.primText')}}</td>
                                    <td class="align-middle">
                                        <div class="w-75 p-4 mx-auto rounded-circle" style="background:{{config('couleurs.primText')}};"></div>
                                    </td>
                                    <td class="align-middle"><span class="fas fa-edit" onclick="couleurs('primText')" data-toggle="modal" data-target="#modal_couleurs"></span></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" rowspan="2">Secondaire</td>
                                    <td class="align-middle">Couleur de fond</td>
                                    <td class="align-middle">{{config('couleurs.secondFond')}}</td>
                                    <td class="align-middle">
                                        <div class="w-75 p-4 mx-auto rounded-circle" style="background:{{config('couleurs.secondFond')}};"></div>
                                    </td>
                                    <td class="align-middle"><span class="fas fa-edit" onclick="couleurs('secondFond')" data-toggle="modal" data-target="#modal_couleurs"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Couleur de texte</td>
                                    <td class="align-middle">{{config('couleurs.secondText')}}</td>
                                    <td class="align-middle">
                                        <div class="w-75 p-4 mx-auto rounded-circle" style="background:{{config('couleurs.secondText')}};"></div>
                                    </td>
                                    <td class="align-middle"><span class="fas fa-edit" onclick="couleurs('secondText')" data-toggle="modal" data-target="#modal_couleurs"></span></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" rowspan="2">Navigation</th>
                                    <td class="align-middle">Couleur de fond</td>
                                    <td class="align-middle">{{config('couleurs.navFond')}}</td>
                                    <td class="align-middle">
                                        <div class="w-75 p-4 mx-auto rounded-circle" style="background:{{config('couleurs.navFond')}};"></div>
                                    </td>
                                    <td class="align-middle"><span class="fas fa-edit" onclick="couleurs('navFond')" data-toggle="modal" data-target="#modal_couleurs"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Couleur de texte</td>
                                    <td class="align-middle">{{config('couleurs.navText')}}</td>
                                    <td class="align-middle">
                                        <div class="w-75 p-4 mx-auto rounded-circle" style="background:{{config('couleurs.navText')}};"></div>
                                    </td>
                                    <td class="align-middle"><span class="fas fa-edit" onclick="couleurs('navText')" data-toggle="modal" data-target="#modal_couleurs"></span></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" rowspan="2">Tableau</th>
                                    <td class="align-middle">Couleur de fond</td>
                                    <td class="align-middle">{{config('couleurs.navFond')}}</td>
                                    <td class="align-middle">
                                        <div class="w-75 p-4 mx-auto rounded-circle" style="background:{{config('couleurs.tabFond')}};"></div>
                                    </td>
                                    <td class="align-middle"><span class="fas fa-edit" onclick="couleurs('tabFond')" data-toggle="modal" data-target="#modal_couleurs"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Couleur de texte</td>
                                    <td class="align-middle">{{config('couleurs.navText')}}</td>
                                    <td class="align-middle">
                                        <div class="w-75 p-4 mx-auto rounded-circle" style="background:{{config('couleurs.tabText')}};"></div>
                                    </td>
                                    <td class="align-middle"><span class="fas fa-edit" onclick="couleurs('tabText')" data-toggle="modal" data-target="#modal_couleurs"></span></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row" rowspan="2">Boutton</th>
                                    <td class="align-middle">Couleur de fond</td>
                                    <td class="align-middle">{{config('couleurs.btnFond')}}</td>
                                    <td class="align-middle">
                                        <div class="w-75 p-4 mx-auto rounded-circle" style="background:{{config('couleurs.btnFond')}};"></div>
                                    </td>
                                    <td class="align-middle"><span class="fas fa-edit" onclick="couleurs('btnFond')" data-toggle="modal" data-target="#modal_couleurs"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">Couleur de texte</td>
                                    <td class="align-middle">{{config('couleurs.btnText')}}</td>
                                    <td class="align-middle">
                                        <div class="w-75 p-4 mx-auto rounded-circle" style="background:{{config('couleurs.btnText')}};"></div>
                                    </td>
                                    <td class="align-middle"><span class="fas fa-edit" onclick="couleurs('btnText')" data-toggle="modal" data-target="#modal_couleurs"></span></td>
                                </tr>
                                <tr>
                                    <th class="align-middle" scope="row">Arrière plan</th>
                                    <td class="align-middle">Couleur de fond</td>
                                    <td class="align-middle">{{config('couleurs.ArrPlan')}}</td>
                                    <td class="align-middle">
                                        <div class="w-75 p-4 mx-auto rounded-circle" style="background:{{config('couleurs.ArrPlan')}};"></div>
                                    </td>
                                    <td class="align-middle"><span class="fas fa-edit" onclick="couleurs('ArrPlan')" data-toggle="modal" data-target="#modal_couleurs"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
<!-- MODAL COULEURS -->
<div class="modal fade" id="modal_couleurs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Modifier une couleur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span id="close_modal" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('adm_couleurs')}}" class="mb-0">
                        @csrf
                        <input type="hidden" id="colorInput" name="colorInput">
                        <div class="form-group">
                            <label for="colorInput">Nouvelle couleur</label>
                            <input type="color" id="valeurInput" name="valeurInput" class="form-control" required>
                        </div>
                        <button type="submit" class="w-100 btn btn-primary">ENREGISTRER</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function couleurs(couleur){
        $('#colorInput').val(couleur);
    }
</script>