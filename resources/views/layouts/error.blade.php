@extends('layouts.app')

@section('styles')

@endsection

@section('content')
    <!-- 404 Error Text -->
    <div class="d-flex justify-content-center align-items-center flex-column" style="height:100vh">
        <div class="error mx-auto" data-text="@yield('code')">@yield('code')</div>
        <p class="lead text-gray-800 mb-2">@yield('message')</p>
        <a href="{{ route('home') }}">&larr; Retour</a>
    </div>
@endsection
