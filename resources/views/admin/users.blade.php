@extends('layouts.layout')

@section('content')
    <table class="table table-sm">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre y Apellido</th>
            <th scope="col">Correo Electronico</th>
            <th scope="col">Role</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>Botones</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
