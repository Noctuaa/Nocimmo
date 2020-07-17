@extends('layouts.admin')
@section('title', 'Liste des propriétés')
@section('content')
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
                                    <th>Catégorie</th>
                                    <th>Adresse</th>
                                    <th>Ajouter</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-900">
                                @if ($realEstates->count() == 0)
                                <tr>
                                    <td colspan="12">Aucune propriété</td>
                                </tr>
                                @else
                                    @foreach ($realEstates as $realEstate)
                                    <tr>
                                        <td>{{$realEstate->name}}</td>
                                        <td>{{Str::ucfirst(__($realEstate->category))}}</td>
                                        <td>{{$realEstate->address}}</td>
                                        <td>{{$realEstate->created_at->format('d/m/Y')}}</td>

                                        <td class="text-center">
                                            <a href="{{URL::route('show.property', [Str::lower(__($realEstate->category)), $realEstate->slug] )}}"
                                                title="Voir" class="btn btn-success btn-circle btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('edit.property', $realEstate->slug)}}" title="Editer"
                                                class="btn btn-info btn-circle btn-sm">
                                                <i class="fas fa-user-edit"></i>
                                            </a>

                                            <a href="{{route('destroy.property', $realEstate->id)}}" title="Supprimer"
                                                class="btn btn-danger btn-circle btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                                <tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</section>

@endsection
