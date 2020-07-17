<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{__(config('app.name', 'Laravel'))}} </title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Adamina&display=swap" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <meta name="robots" content="noindex, nofollow">
</head>

<body class="hold-transition sidebar-mini">
    <div id="app">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Profil -->
                    <li class="dropdown nav-item user-menu d-flex align-items-center">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            @if (Auth::user()->avatar)
                            <img class="user-image" src="{{ url(Auth::user()->avatar) }}?{{ time() }}" alt="User Image">
                            @else
                            <img class="user-image" src="{{asset('/images/avatars/user_default.jpg?' . time())}}" alt="User Image">
                            @endif
                            <span class="hidden-xs">{{ ucfirst(Auth::user()->name) }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                @if (Auth::user()->avatar)
                                <img class="img-profile rounded-circle img-circle elevation-2"
                                    src="{{ url(Auth::user()->avatar) }}?{{ time() }}" alt="User Image">
                                @else
                                <img class="img-profile rounded-circle img-circle elevation-2"
                                    src="{{asset('/images/avatars/user_default.jpg?' . time())}}}}" alt="User Image">
                                @endif

                                <p>
                                    {{ ucfirst(Auth::user()->name) }} - {{ ucfirst(Auth::user()->role) }}
                                    <small>Membre depuis le
                                        {{ isset(Auth::user()->created_at) ? Auth::user()->created_at->format('d/m/Y') : Auth::user()->email }}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="card-body bg-light">
                                <div class="row justify-content-around">
                                    <div class="pull-left">
                                        <a href="{{route('edit.user', Auth::user()->slug)}}" role="button"
                                            class="btn btn-block btn-outline-primary">Mon
                                            profil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" role="button"
                                            class="btn btn-block btn-outline-primary">{{ __('Déconnection') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{route('home')}}" class="brand-link images">
                    <img src="{{asset('/adminlte/dist/img/Logo_mini.png')}}" alt="Chalets et caviar Logo" class="ml-1"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">Chalets et Caviar</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <li class="nav-item">
                                <a href="{{route('admin.index')}}"
                                    class="nav-link {{ (\Request::route()->getName() == 'admin.index') ? 'active' : '' }}">
                                    <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                                    <p>Tableau de Bord</p>
                                </a>
                            </li>
                            <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                            <li class="nav-item has-treeview {{ Request::is('dashboard/user*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ Request::is('dashboard/user*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Utilisateurs
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('edit.user', Auth::user()->slug)}}"
                                            class="nav-link {{ (\Request::route()->getName() == 'edit.user') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Mon Profil</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('index.user')}}"
                                            class="nav-link {{ (\Request::route()->getName() == 'index.user') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Voir les Utilisateurs</p>
                                        </a>
                                    </li>
                                    @if (Auth::user()->role === "admin")
                                        <li class="nav-item">
                                            <a href="{{route('register.user')}}"
                                                class="nav-link {{ (\Request::route()->getName() == 'register.user') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Ajouter un Utilisateur</p>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            <li
                                class="nav-item has-treeview {{ Request::is('dashboard/property*') ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ Request::is('dashboard/property*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-home"></i>
                                    <p>
                                        Propriétés
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{route('index.property')}}"
                                            class="nav-link {{ (\Request::route()->getName() == 'index.property') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Voir les Propriétés</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('add.property')}}"
                                            class="nav-link {{ (\Request::route()->getName() == 'add.property') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ajouter une Propriété</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('index.equipment')}}"
                                            class="nav-link {{ (\Request::route()->getName() == 'index.equipment') ? 'active' : '' }}">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Équipement</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="h3 m-0 text-dark">@yield('title')</h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <!-- Main Footer -->
            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    Nocdev
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
                reserved.
            </footer>
        </div>
        <!-- ./wrapper -->
    </div>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('/adminlte/plugins/jquery/jquery.min.js')}}"></script>

    <!-- AdminLTE App -->
    <script src="{{asset('/adminlte/dist/js/adminlte.min.js')}}"></script>
</body>

</html>
