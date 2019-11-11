@extends('layouts.layout')

@section('content')
    <table class="table table-sm">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Creado</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)
        <tr>
            <th scope="row">{{ $group->id }}</th>
            <td>{{ $group->name }}</td>
            <td>{{ $group->description }}</td>
            <td>{{ $group->created_at }}</td>
            <td>Botones</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $groups->links() }}
@endsection
