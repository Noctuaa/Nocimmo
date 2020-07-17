@extends('layouts.admin')
@section('title', __('Ajouter une propriété'))
@section('content')
<section>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="p-md-5 p-sm-3 p-0">
                        @include('immo.form', ['action' => 'store'])
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection