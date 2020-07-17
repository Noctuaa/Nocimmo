@extends('layouts.admin')
@section('title'){{__('Liste des utilisateurs')}}@endsection
@section('content')
<div class="container-fluid">
    <section>
        <!-- DataTales Example -->
        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Rôle</th>
                                        @if(Auth::user()->role === 'admin')
                                            <th>Actions</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="text-gray-900">
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->role}}</td>
                                        @if(Auth::user()->role === 'admin')
                                        <td class="text-center">
                                            <a href="{{ action('UserController@edit', $user->slug)}}"
                                                title="Voir l'utilisateur" class="btn btn-info btn-circle btn-sm">
                                                <i class="fas fa-user-edit"></i>
                                            </a>

                                            <a href="{{ action('UserController@destroy', $user->id)}}"
                                                title="Supprimer l'utilisateur"
                                                class="btn btn-danger btn-circle btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                    <tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@stop
