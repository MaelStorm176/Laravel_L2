@extends('layouts.base')
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-6">
                <div class="card border-success mb-3">
                    <div class="card-header bg-success text-white">Change ton adresse mail<span class="fas fa-envelope float-right mt-1"></span></div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="inputEmail3">Nouveau E-mail</label>
                                <input type="email" class="form-control" id="inputEmail3">
                            </div>
                            <div class="form-group">
                                <label for="inputEmail4">Retape ton nouveau e-mail</label>
                                <input type="email" class="form-control" id="inputEmail4">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-danger mb-3">
                    <div class="card-header bg-danger text-white">Change ton mot de passe<span class="fas fa-lock float-right mt-1"></span></div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="inputPassword">Nouveau mot de passe</label>
                                <input type="password" class="form-control" id="inputPassword">
                            </div>
                            <div class="form-group">
                                <label for="inputPassword2">Retape ton nouveau mot de passe</label>
                                <input type="password" class="form-control" id="inputPassword2">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Valider</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Mes cartes de paiement enregistrés<span class="fas fa-credit-card float-right mt-1"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-0 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Propriétaire</th>
                                    <th scope="col">Numéro</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">DUPONT Jean</th>
                                    <td>XXXX-XXXX-XXXX-5732</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">DUPONT Jean</th>
                                    <td>XXXX-XXXX-XXXX-5732</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">DUPONT Jean</th>
                                    <td>XXXX-XXXX-XXXX-5732</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">DUPONT Jean</th>
                                    <td>XXXX-XXXX-XXXX-5732</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-secondary mb-3">
                    <div class="card-header bg-secondary text-white">Mes adresses enregistrées<span class="fas fa-map-pin float-right mt-1"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-0 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Ville</th>
                                    <th scope="col">Code Postal</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>n°112 rue de la gare</td>
                                    <td>REIMS</td>
                                    <td>51100</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                                <tr>
                                    <td>n°112 rue de la gare</td>
                                    <td>REIMS</td>
                                    <td>51100</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                                <tr>
                                    <td>n°112 rue de la gare</td>
                                    <td>REIMS</td>
                                    <td>51100</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                                <tr>
                                    <td>n°112 rue de la gare</td>
                                    <td>REIMS</td>
                                    <td>51100</td>
                                    <td><span class="fas fa-trash-alt"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection