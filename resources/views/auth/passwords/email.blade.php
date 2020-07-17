@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh">
        <div class="card">
            <div class="card-body border-0 shadow-lg">
                <div class="p-md-5 p-3">
                    <div class="text-center">
                        <h1 class="h4 mb-4">Réinitialisation du mot de passe</h1>
                    </div>
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="{{ __('Adresse Email') }}"
                                autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row justify-content-center">
                            <button type="submit" class="btn btn-primary btn-user">
                                {{ __('Envoyer') }}
                            </button>
                        </div>
                    </form>

                    <hr>
                    <div class="text-center">
                        <a class="btn btn-link" href="{{ route('login') }}">
                            {{ __('Connexion') }}
                        </a>
                    </div>
                    <div class="text-center">
                        <a class="btn btn-link" href="{{ route('home') }}">
                            {{ __('Retour vers Chalets et caviar') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
