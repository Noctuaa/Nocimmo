@extends('layouts.admin')
@section('title', 'Équipement')
@section('content')
<section>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-6">
                <div class="card card-primary border-0 shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">Ajouter un équipement</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                <form role="form" method="POST" action="{{route('store.equipment')}}" >
                    @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nom de l'équipement</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"  name="name" id="equipement"
                                value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Entrer un équipement">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card card-primary border-0 shadow-lg">
                    <div class="card-header">
                        <h3 class="card-title">Liste</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Équipement</th>
                                    <th style="width: 40px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($equipment as $key => $item)
                                <tr>
                                    <td>{{$key + 1}}.</td>
                                    <td>{{$item->name}}</td>
                                    <td class="text-center">
                                        <form action="{{route('delete.equipment', $item->id)}}" method="post">
                                            @csrf
                                            <button class="btn btn-danger btn-circle btn-sm" type="submit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>                                          
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
