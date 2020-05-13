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
                            <th scope="col">Jours</th>
                            <th scope="col">Midi</th>
                            <th scope="col">Soir</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($horaires as $key)
                        <tr>
                            <th class="bg-info text-white" scope="row">{{$key->jour}} </th>
                            <td id="{{$key->jour}}_midi" @if($key->midi == 'Fermé') class="bg-danger text-white" @else class="bg-success text-white" @endif>{{$key->midi}}</td>
                            <td id="{{$key->jour}}_soir" @if($key->soir == 'Fermé') class="bg-danger text-white" @else class="bg-success text-white" @endif>{{$key->soir}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
