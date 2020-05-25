@extends('layouts.base2')
@section('titre')
    Vérifier votre adresse mail
@endsection
@section('contenu')
    <div class="modal-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('Un nouveau lien de vérification a été envoyé à votre adresse mail:') }} {{Auth::user()->email}}
            </div>
        @endif
        <p class="text-justify mb-0">
            {{ __('Avant de continuer, consultez vos emails pour un lien de vérification. Si vous n\'avez pas reçu le mail, veuillez cliquer sur le boutton pour en envoyer un autre.') }}
        </p>
    </div>
    <div class="modal-footer">
        <a href="{{route('/')}}" class="btn btn-secondary">
            Retour
        </a>
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-primary">{{ __('Envoyer un mail de vérification') }}</button>.
        </form>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Vérifie ton adresse mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Une nouveau lien de vérification a été envoyé à votre adresse mail.') }}
                        </div>
                    @endif

                    {{ __('Avant de continuer, consultez vos mail pour un lien de vérification.') }}
                    {{ __('Si vous n\'avez pas reçu de mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Cliquez ici pour envoyer un mail de vérification') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
