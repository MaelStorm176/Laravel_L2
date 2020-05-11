@extends('layouts.adm')
@section('titre')
    CODE PROMOTIONELS<span class="fas fa-gift mt-1 ml-1"></span>
@endsection
@section('contenu')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Générer un code supplémentaire<span class="fas fa-plus-circle mt-1 float-right"></span></div>
                    <div class="card-body">
                        <form action="{{ route('code.upload') }}" id="formucode" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_code" id="id_code">
                            <section class="row">
                                <div class="col-lg-6 mb-4">
                                    <label for="remise">Remise en %</label>
                                    <input type="text" name="remise" placeholder="Remise" id="remise" class="form-control" required>
                                </div>
                                <div class="col-lg-6 mb-4">
                                    <label for="date_limite">Date de fin</label>
                                    <input type="date" name="date_limite" id="date_limite" class="form-control">
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary text-white w-100">GENERER</button>
                                </div>
                            </section>            
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card border-info mb-3">
                    <div class="card-header bg-info text-white">Codes promotionels actifs<span class="fas fa-bars mt-1 float-right"></span></div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-3 text-center">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="align-middle" scope="col">CODE</th>
                                    <th class="align-middle" scope="col">REMISE</th>
                                    <th class="align-middle" scope="col">DATE DE FIN</th>
                                    <th class="align-middle" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-middle">65dsfsdffd65</td>
                                    <td class="align-middle">20%</td>
                                    <td class="align-middle">11/05/2020</td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">65dsfsdffd65</td>
                                    <td class="align-middle">20%</td>
                                    <td class="align-middle">11/05/2020</td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">65dsfsdffd65</td>
                                    <td class="align-middle">20%</td>
                                    <td class="align-middle">11/05/2020</td>
                                    <td class="align-middle"><span class="fas fa-trash-alt btn"></span></td>
                                </tr>
                                <tr>
                                    <td class="align-middle">65dsfsdffd65</td>
                                    <td class="align-middle">20%</td>
                                    <td class="align-middle">11/05/2020</td>
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