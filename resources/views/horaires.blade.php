@extends('layouts.base')
@section('content')
    <div class="container">
        <section class="row">
            <div class="col-lg-12">
                <div class="card border-one mb-3">
                    <div class="card-header bg-one text-one ">
                        Nos horaires<span class="fas fa-clock mt-1 float-right"></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered mb-0 text-center">
                            <thead class="bg-tab text-tab">
                                <tr>
                                    <th scope="col">Jours</th>
                                    <th scope="col">Midi</th>
                                    <th scope="col">Soir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($horaires as $key)
                                    <tr>
                                        <th scope="row">{{$key->jour}}</th>
                                        <td id="{{$key->jour}}_midi" @if($key->midi == 'Fermé') class="bg-danger text-white" @else class="bg-success text-white" @endif>{{$key->midi}}</td>
                                        <td id="{{$key->jour}}_soir" @if($key->soir == 'Fermé') class="bg-danger text-white" @else class="bg-success text-white" @endif>{{$key->soir}}</td>
                                    </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-3 border-two">
                    <div class="card-header bg-two text-two">
                        Période de fermeture prévues
                        <span class="fas fa-door-closed mt-1 float-right"></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered text-center mb-0">
                            <thead class="bg-tab text-tab">
                                <tr>
                                    <th scope="col">Date début</th>
                                    <th scope="col">Date fin</th>
                                    <th scope="col">Motif</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fermetures as $key)
                                    <tr>
                                        <td class="align-middle">{{$key->date_debut}}</td>
                                        <td class="align-middle">{{$key->date_fin}}</td>
                                        <td class="align-middle">{{$key->motif}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-3 border-two">
                    <div class="card-header bg-two text-two">
                        Jours fériés ouverts
                        <span class="fas fa-calendar-day mt-1 float-right"></span>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered text-center mb-0">
                            <thead class="bg-tab text-tab">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Midi</th>
                                    <th scope="col">Soir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($feriees as $key)
                                    <tr>
                                        <td class="align-middle">{{$key->jour}}</td>
                                        <td @if($key->midi == 'Fermé') class="bg-danger text-white align-middle" @else class="bg-success text-white align-middle" @endif>{{$key->midi}}</td>
                                        <td @if($key->soir == 'Fermé') class="bg-danger text-white align-middle" @else class="bg-success text-white align-middle" @endif>{{$key->soir}}</td>
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
