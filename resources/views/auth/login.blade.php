@extends('layouts.auth')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh">
        <div class="col-12">
            <div class="card card-auth flex-row border-0 shadow-lg">
                <div class="col-md-6 card-img-left" id="bg-login-image" style="background-image: url('{{asset('/images/bg_auth.jpg')}}')"></div>
                <div class="col-md-12 col-lg-6">
                    <div class="p-md-5 p-3">
                        <div class="text-center">
                            <h1 class="h4 mb-4">Login</h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="{{ __('Adresse Email') }}"
                                    required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password" placeholder="{{ __('Mot de passe') }}">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label " for="remember">
                                        {{ __('Se souvenir de moi') }}
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <button type="submit" class="btn btn-primary btn-user">
                                    {{ __('Se connecter') }}
                                </button>
                            </div>
                        </form>

                        <hr>

                        <div class="text-center">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                            @endif
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
</div>
@endsection
