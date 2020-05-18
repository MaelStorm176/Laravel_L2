@extends('layouts.base2')
@section('titre')
    Réinitialiser votre mot de passe
@endsection
@section('contenu')
    <form method="POST" class="mb-0" action="{{ route('password.email') }}">
        @csrf
        <div class="modal-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="form-group">
                <label for="email">Adresse Mail</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <a href="{{route('/')}}" class="btn btn-secondary">
                Retour
            </a>
            <button type="submit" class="btn btn-primary">
                Envoyer un lien de réinitialisation
            </button>
        </div>
    </form>
@endsection