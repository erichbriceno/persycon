@extends('layouts.layout')

@section('content')
    <table class="table table-sm">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Inicio</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
        <tr>
            <th scope="row">{{ $project->id }}</th>
            <td>{{ $project->name }}</td>
            <td>{{ $project->description }}</td>
            <td>{{ $project->created_at }}</td>
            <td>Botones</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $projects->links() }}
@endsection
