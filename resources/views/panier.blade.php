@extends('layouts.app')
<?php $q_tot = 0;?>
@section('content')
    <div class="content" id="content">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Article</th>
                <th scope="col">Prix</th>
                <th scope="col">Quantité</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $key)
                <tr id="{{$key->id}}">
                    <td>{{$key->nom}}</td>
                    <td>{{$key->promo}} €</td>
                    <td><input type="number" value="{{$key->quantite}}" onchange="modifier(this)"></td>
                </tr>
                <!-- {{$q_tot += $key->quantite}} -->
            @endforeach
        </tbody>
        <tr>
            <th scope="col">Prix total</th>
            <th scope="col">{{$prix_total}} €</th>
            <th scope="col">{{$q_tot}} articles au total</th>
        </tr>
    </table>
        <a href="#"><button class="btn btn-dark">Valider et passer la commande</button></a>
    </div>
@endsection
