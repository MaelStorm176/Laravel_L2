@extends('layouts.base2')
@section('titre')
    Réinitialiser votre mot de passe
@endsection
@section('contenu')
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="modal-body">
            <div class="form-group">
                <label for="email">Adresse Mail</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror            
            </div>
            <div class="form-group">
                <label for="password">Nouveau mot de passe</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm">Retape ton nouveau mot de passe</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                
            </div>    
        </div>
        <div class="modal-footer">
            <a href="{{route('/')}}" class="btn btn-secondary">
                Retour
            </a>
            <button type="submit" class="btn btn-primary">
                Réinitialiser le mot de passe
            </button>
        </div>
    </form>
@endsection