@extends('layouts.base')
@section('content')

    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card bg-success text-white text-center p-3 font-weight-bold font-italic mb-3">
                    <h5 class="mb-0">NOS HORAIRES</h5>
                </div>
                <table class="table table-hover table-bordered mb-3 text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Midi</th>
                            <th scope="col">Soir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="bg-info text-white" scope="row">Lundi</th>
                            <td class="bg-success text-white">11h/14h</td>
                            <td class="bg-success text-white">18h30/22h30</td>
                        </tr>
                        <tr>
                            <th class="bg-info text-white" scope="row">Mardi</th>
                            <td class="bg-success text-white">11h/14h</td>
                            <td class="bg-success text-white">18h30/22h30</td>
                        </tr>
                            <tr>
                            <th class="bg-info text-white" scope="row">Mercredi</th>
                            <td class="bg-danger text-white">Fermé</td>
                            <td class="bg-danger text-white">Fermé</td>
                        </tr>
                        <tr>
                            <th class="bg-info text-white" scope="row">Jeudi</th>
                            <td class="bg-success text-white">11h/14h</td>
                            <td class="bg-success text-white">18h30/22h30</td>
                        </tr>
                        <tr>
                            <th class="bg-info text-white" scope="row">Vendredi</th>
                            <td class="bg-success text-white">11h/14h</td>
                            <td class="bg-success text-white">18h30/22h30</td>
                        </tr>
                        <tr>
                            <th class="bg-info text-white" scope="row">Samedi</th>
                            <td class="bg-danger text-white">Fermé</td>
                            <td class="bg-success text-white">18h30/22h30</td>
                        </tr>
                        <tr>
                            <th class="bg-info text-white" scope="row">Dimanche</th>
                            <td class="bg-success text-white">11h/14h</td>
                            <td class="bg-success text-white">18h30/22h30</td>
                        </tr>
                        <tr>
                            <th class="bg-info text-white" scope="row">Jours Fériés</th>
                            <td class="bg-danger text-white">Fermé</td>
                            <td class="bg-success text-white">18h30/22h30</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection