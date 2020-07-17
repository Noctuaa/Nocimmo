@extends('layouts.admin')

@section('title'){{__('Tableau de bord')}}@endsection

@section('content')
    <section class="d-flex justify-content-center">
        <div class="card-deck">
                <div class="card card-dashboard text-white d-flex align-items-center border_left_primary shadow py-2" style="background-image: url('{{asset('/images/post.jpg')}}')">
                    <div class="card-body d-flex justify-content-center flex-column align-items-center" >
                        <div class="card_logo mb-3 text-center">
                            <font-awesome-icon class="fa-icon" icon="home" />
                        </div>
                    <p class="h4 font-weight-bold text-center mb-4">{{$estatesCount}} {{$estatesCount > 1 ? 'Publications' : 'Publication'}}</p>
                        <a class="btn btn-primary pr-5 pl-5" href="{{route('index.property')}}" role="button">Voir</a>
                    </div>
                </div>

                <div class="card card-dashboard text-white d-flex align-items-center border_left_primary shadow py-2" style="background-image: url('{{asset('/images/users.jpg')}}')">
                    <div class="card-body d-flex justify-content-center flex-column align-items-center" >
                        <div class="card_logo mb-3 text-center">
                            <font-awesome-icon class="fa-icon" icon="users" />
                        </div>
                        <p class="h4 font-weight-bold text-center mb-4">{{$userCount}} {{$userCount > 1 ? 'Utilisateurs' : 'Utilisateur'}}</p>
                        <a class="btn btn-primary pr-5 pl-5" href="{{route('index.user')}}" role="button">Voir</a>
                    </div>
                </div>
            </div>
    </section>
@endsection
