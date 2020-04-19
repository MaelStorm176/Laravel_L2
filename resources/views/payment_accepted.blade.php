@extends('layouts.app')
@section('content')

    @auth
    <h1>Paiement effectué</h1>
    <form action="{{route('home')}}" method="get">
        <button type="submit">Retour</button>
    </form>
    @endauth

@endsection
