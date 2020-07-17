@extends('layouts.admin')
@section('title'){{__($user->name)}}@endsection
@section('content')
<section>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-10 d-flex justify-content-center">
                <div class="card card-auth flex-row border-0 shadow-lg">
                    <div class="p-5">
                        <form class="user" method="POST" action="{{ route('update.user', $user->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            
                            <input type="hidden" name="slug" id="slug">

                            <div class="d-flex flex-column align-items-center">
                                @if ($user->avatar == true)
                                <img class="img-profile rounded-circle mb-3" src="{{ url($user->avatar) }}?{{ time() }}" loading="lazy" alt="Photo Utilsateur Default" style="width: 160px; height:160px">
                                @else
                                <img class="img-profile rounded-circle mb-3" src="{{ asset('/images/avatars/user_default.jpg?' . time()) }}" loading="lazy" style="width: 160px; height:160px" alt="Photo Utilisateur">
                                @endif
                                <div class="input-group mb-3">
                                    <input class="input-file  @error('avatar') is-invalid @enderror " name="avatar"
                                        type="file" id="avatar">
                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            @if ($user->avatar)
                            <div class="input-group mb-3">
                                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                    <input class="custom-control-input" type="checkbox" name="delete" id="delete">
                                    <label class="custom-control-label " for="delete">
                                        {{ __('Supprimer mon avatar') }}
                                    </label>
                                </div>
                            </div>
                            @endif

                            <div class="input-group mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" required value="{{ $user->name }}" autocomplete="name" autofocus
                                    placeholder="Nom">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $user->email }}" required autocomplete="email"
                                    placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group row justify-content-center">
                                <button type="submit" class="btn btn-primary btn-user">
                                    {{ __('Modifier') }}
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@endsection
