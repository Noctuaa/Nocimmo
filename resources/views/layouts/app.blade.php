<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{__(config('app.name', 'Laravel'))}} </title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/ScrollTrigger.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.3.4/ScrollToPlugin.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Adamina&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Arapey:400i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body>
    <div id="app">
        <backtop></backtop>
        <div class="nav_header d-flex">
            <nav_mobile :url="{{json_encode([route('category', 'ventes'), route('category', 'locations')])}}"></nav_mobile>
            <div class="container d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a class="brand_link d-flex justify-content-center" href="{{ route('home') }}">
                        <img src="{{asset('/images/Logo_solo.png')}}" alt="logo">
                        <span class="brand_text text-center">Chalets et <br> Caviar</span>
                    </a>
                </div>
                <nav id="access">
                    <ul>
                        <li>
                            <a class="{{ (\Request::route()->getName() == 'home') ? 'active' : '' }}"
                                href="/">Accueil</a>
                        </li>
                        <li>
                            <a class="{{ Request::is('vente*') ? 'active' : '' }}"
                                href="{{route('category', 'ventes')}}">Ventes</a>
                        </li>
                        <li>
                            <a class="{{Request::is('location*') ? 'active' : ''}}"
                                href="{{route('category', 'locations')}}">Locations</a>
                        </li>
                        @if (Auth::user())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ ucfirst(Auth::user()->name) }}<span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('admin.index') }}">
                                    {{ __('Administration') }}
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Déconnection') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endif
                    </ul>
                </nav><!-- #access -->
            </div>
        </div>

        @yield('content')
        <footer>
            <div class="container">
                <div class="row d-flex" id="footer-widget">
                    <div class="footer_category col-md-4 col-12" id="contact_footer">
                        <h3>Contact</h3>
                        <ul>
                            <li class="d-inline-flex align-items-center">
                                <font-awesome-icon class="fa" icon="map-marker-alt"></font-awesome-icon>
                                15 Rue du chemin <br>Courchevel 73120 Savoie
                            </li>
                            <li>
                                <font-awesome-icon class="fa" icon="desktop"></font-awesome-icon>
                                <a href="www.nocdev.com">www.nocdev.com</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer_category col-md-4 col-12" id="social_footer">
                        <h3>Réseaux Sociaux</h3>
                        <ul class="d-inline-flex justify-content-center">
                            <li>
                                <a href="#">
                                    <font-awesome-icon :icon="['fab', 'facebook-f']" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <font-awesome-icon :icon="['fab', 'twitter']" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <font-awesome-icon :icon="['fab', 'instagram']" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <font-awesome-icon :icon="['fab', 'linkedin-in']" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer_category col-md-4 col-12" id="last_ad_footer">
                        <h3>Dernières annonces</h3>
                        <ul>
                            @foreach($lastEstates as $lastEstate)
                            <li class="lastest" style="margin-bottom:13px">
                                <a class="d-flex"
                                    href="{{URL::route('show.property', [Str::lower(__($lastEstate->category)), $lastEstate->slug] )}}">
                                    <div class="latest__image">
                                        <img src="{{url('/images/realEstates/' . $lastEstate->id . '/Thumbnail/thumbnail_mini_'. $lastEstate->id .'.jpg')}}"
                                            style="width:102px; height:68px; border-radius:4px" lazy="loading"
                                            alt="Image {{$lastEstate->name}}">
                                    </div>
                                    <div class="latest__info" style="padding-left:13px">
                                        <span style="color:white">{{$lastEstate->name}}</span>
                                        <br>
                                        En {{Str::lower(__(Str::singular($lastEstate->category)))}}
                                        <br>
                                        {{number_format($lastEstate->price, 0, '.', ' ') }} €
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright text-center my-auto">
                <span>Copyright © Nocdev 2020</span>
            </div>
        </footer>
    </div>
    <!----Javascript----->
    @yield('script')
    <script>
        window.onload = (e) => {
            window.addEventListener('scroll', () => {
                if (window.matchMedia("(min-width: 992px)").matches) {
                    window.pageYOffset <= 80 ? gsap.to('.nav_header', { height: '', duration: 0.1}) : gsap.to(".nav_header", {height:70 ,duration: 0.1});
                }                   
            })
        }
    </script>
</body>

</html>
