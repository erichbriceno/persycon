@extends('layouts.layout')

@section('title', $title )

@section('content')
    <table class="table table-sm">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col" class="text-center">Grupos Asociados</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($managements as $management)
        <tr>
            <th scope="row">{{ $management->id }}</th>
            <td>{{ $management->name }}</td>
            <td>{{ $management->description }}</td>
            <td class="text-center">4</td>
            <td>Botones</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $managements->links() }}
@endsection
