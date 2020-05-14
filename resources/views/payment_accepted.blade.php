@extends('layouts.base2')
@section('titre')
    Paiement effectué
@endsection
@section('contenu')
    <div class="modal-body">
        <form action="{{route('/')}}" method="get">
            <button type="submit" class="btn btn-primary w-100">
                RETOUR AU SITE
                <span class="fas fa-arrow-alt-circle-left mt-1 align-center"></span>
            </button>
        </form>
    </div>
@endsection