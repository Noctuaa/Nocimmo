@extends('layouts.app')
@section('title', 'Nos '.__($title) . ' |')

@section('content')
<div id="banner" style="background-image: url('{{asset('/images/courchevel_snow.jpg')}}')"></div>
<div class="container">
    <section class="content">
        <h1 class="mb-5">Nos {{__($title)}}</h1>
        <div class="row d-flex justify-content-center">
            <list-estate></list-estate>
            <search-filter></search-filter>
        </div>
    </section>
</div>
@endsection
