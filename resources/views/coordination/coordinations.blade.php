@extends('layouts.layout')

@section('content')
    
    @includeWhen($view == 'index', 'coordination._menu')
    @includeWhen($view == 'trash', 'coordination._back')  
    
    @if ($coordinations->isNotEmpty())
        <table class="table table-sm">
            <thead class="thead-light">
            <tr>
                <th scope="col">@lang('Name')</th>
                <th scope="col">@lang('Description')</th>
                <th scope="col">@lang('Management')</th>
                <th scope="col" class="text-center">@lang('Groups')</th>
                <th scope="col" class="text-center">@lang('Status')</th>
                <th scope="col" class="text-center">@lang('Actions')</th>
            </tr>
            </thead>
            <tbody>
                @each('coordination._row', $coordinations, 'coordination')
            </tbody>
        </table>
        {{ $coordinations->onEachSide(1)->links() }}
    @else
        <h4>{{trans("coordinations.emptyMessage.{$view}")}}</h4>
    @endif    
@endsection
