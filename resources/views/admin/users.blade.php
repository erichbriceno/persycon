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
        <tr>
            <th scope="row">1</th>
            <td>Erich Briceno</td>
            <td>erichbriceno@gmail.com</td>
            <td>Master</td>
            <td>Botones</td>
        </tr>
        <tr>
            <th scope="row">1</th>
            <td>Penelope Medina</td>
            <td>penedina@gmail.com</td>
            <td>Analista</td>
            <td>Botones</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Carlos Andrade</td>
            <td>candradeo@gmail.com</td>
            <td>Admin</td>
            <td>Botones</td>
        </tr>

        </tbody>
    </table>
@endsection
