@extends('layouts.layout')

@section('content')
    <table class="table table-sm">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($coordinations as $coordination)
        <tr>
            <th scope="row">{{ $coordination->id }}</th>
            <td>{{ $coordination->name }}</td>
            <td>{{ $coordination->description }}</td>
            <td>Botones</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $coordinations->links() }}
@endsection
