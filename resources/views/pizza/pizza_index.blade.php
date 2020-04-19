@extends('layouts.app')
@section('content')
    {{ \App\Http\Controllers\Pizza::afficher() }}
@endsection
