@extends('layouts.app')
@section('title', __($realEstate->name) . ' |')
@section('content')
<!-- Page Heading -->

<div id="banner"></div>
<div class="container">
    <section class="content" id="show">
        <div class="row">
            <div class="col-12 d-flex justify-content-between flex-column flex-sm-row">
                <p>
                    <span class="h2 pb-1">{{$realEstate->name}}</span>
                    <br>
                    {{$realEstate->address}}
                </p>
                <p class="h2">{{number_format($realEstate->price, 0, '.', ' ') }} €</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <carousel name="{{$realEstate->name}}" url="{{json_encode($realEstate->images)}}"></carousel>
            </div>
        </div>
        <div class="row details">
            <div class="col-lg-6 col-md-12 text-center">
                <h2>Description</h2>
                <p>{{$realEstate->description}}</p>
            </div>
            <hr class="mb-3 d-lg-none ml-auto mr-auto">
            <div class="col-lg-6 col-md-12 text-center">
                <h2>Détails</h2>
                <ul class="list-inline row d-flex justify-content-center">
                    <li class="list-inline-item pb-2 col-lg-5 col-sm-5 col-6"><strong>Propriété id:</strong>
                        {{$realEstate->id}}</li>
                    <li class="list-inline-item pb-2 col-lg-5 col-sm-5 col-6"><strong>Prix:</strong>
                        {{number_format($realEstate->price, 0, '.', ' ') }} €</li>
                    <li class="list-inline-item pb-2 col-lg-5 col-sm-5 col-6"><strong>Superficie:</strong>
                        {{$realEstate->area}} m² </li>
                    <li class="list-inline-item pb-2 col-lg-5 col-sm-5 col-6"><strong>Chambre:</strong>
                        {{$realEstate->bedroom}}</li>
                    <li class="list-inline-item pb-2 col-lg-5 col-sm-5 col-6"><strong>Salle de bain:</strong>
                        {{$realEstate->bathroom}}</li>
                    <li class="list-inline-item pb-2 col-lg-5 col-sm-5 col-6"><strong>WC:</strong> {{$realEstate->wc}}
                    </li>
                </ul>
            </div>
            <hr class="mb-3 ml-auto mr-auto">
            <div class="col-12 justify-content-center align-items-center d-flex flex-column text-center">
                <h2>Équipements</h2>
                <ul class="list-inline row d-flex justify-content-center col-lg-6 col-12">
                    @foreach (App\Equipment::pluck('name', 'id') as $key => $value)
                    <li class="list-inline-item align-items-center p-2 d-flex flex-wrap">
                        @if (isset($equipment[$key]) && $value == $equipment[$key])
                        <font-awesome-icon class="fa-check mr-2" icon="check" />
                        </font-awesome-icon> {{$value}}
                        @else
                        <font-awesome-icon class="fa-times mr-2" icon="times" />
                        </font-awesome-icon> {{$value}}
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
</div>

@endsection
