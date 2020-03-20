@extends('layouts.layout')

@section('content')

    <div class="row row-filters pb-1">
        <div class="col-12">
            <div class="form-inline justify-content-end">
                <a href="#" class="btn btn-outline-secondary btn-sm">@lang('Trash')</a>
                &nbsp;
                <a href="#" class="btn btn-primary btn-sm">Crear Projecto</a>
            </div>
        </div>
    </div>

    <table class="table table-sm">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th colspan="4" scope="col" class="text-center">Contratados</th>
            <th scope="col" class="text-center">Fechas</th>
            <th scope="col" class="text-center">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
        <tr>
            <th scope="row">{{ $project->id }}</th>
            <td>{{ $project->name }}</td>
            <td>{{ $project->description }}</td>
            <td>
                <span class="note-black">L1</span>
                <span class="note-black">10</span>
            </td>
            <td>
                <span class="note-black">L2</span>
                <span class="note-black">30</span>
            </td>
            <td>
                <span class="note-black">L3</span>
                <span class="note-black">100</span>
            </td>
            <td>
                <span class="note-black">L4</span>
                <span class="note-black">1500</span>
            </td>
            <td>
                <span class="note-black">Inicio: {{ $project->created_at->format('d/m/Y') }}</span>
                <span class="note">Fin: {{ optional($project->ends)->format('d/m/Y h:ia') ?: '-' }}</span>
            </td>
            <td class="text-center">
                <a href="#" class="btn btn-outline-secondary btn-sm"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                <a href="#" class="btn btn-outline-secondary btn-sm"><i class="fas fa-trash-alt"></i></a>             
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $projects->links() }}
@endsection
