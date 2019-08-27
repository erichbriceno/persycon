@extends('layouts.layout')

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
        <tr>
            <th scope="row">1</th>
            <td>Mariche</td>
            <td>Galpon CNE Mariche</td>
            <td class="text-center">4</td>
            <td>Botones</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>CNS</td>
            <td>Centro Nacional de Soporte</td>
            <td class="text-center">1</td>
            <td>Botones</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>ODC</td>
            <td>Oficinas Decentralizadas</td>
            <td class="text-center">0</td>
            <td>Botones</td>
        </tr>
        </tbody>
    </table>
@endsection
