@extends('layouts.layout')

@section('content')

    @includeWhen($view == 'index', 'group._menu')
    @includeWhen($view == 'trash', 'group._back')

    @if ($groups->isNotEmpty())
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
                @each('group._row', $groups, 'group')
            </tbody>
        </table>
        {{ $groups->onEachSide(1)->links() }}
    @else
        <h4>{{trans("groups.emptyMessage.{$view}")}}</h4>
    @endif
@endsection
