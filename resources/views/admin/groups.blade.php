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
        <tr>
            <th scope="row">1</th>
            <td>Lineas</td>
            <td>Lineas de Produccion</td>
            <td>01/09/2019</td>
            <td>Botones</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Soporte</td>
            <td>Soporte de Maquinas</td>
            <td>01/09/2019</td>
            <td>Botones</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>Despacho</td>
            <td>Despacho y carga</td>
            <td>01/09/2019</td>
            <td>Botones</td>
        </tr>
        </tbody>
    </table>
@endsection
