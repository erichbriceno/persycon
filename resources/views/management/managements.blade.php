@extends('layouts.layout')

@section('content')

    @includeWhen($view == 'index', 'management._menu')
    @includeWhen($view == 'trash', 'management._back')
    
    @if ($managements->isNotEmpty())
        <table class="table table-sm table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">@lang('Acronym')</th>
                <th scope="col">@lang('Name')</th>
                <th scope="col" class="text-center">@lang('Coordinations')</th>
                <th scope="col" class="text-center" colspan="4" >@lang('Staff')</th>
                <th scope="col" class="text-center" colspan="3" >@lang('Status')</th>
                <th scope="col" class="text-center">@lang('Actions')</th>
            </tr>
            </thead>
            <tbody>
                @each('management._row', $managements, 'management')
            </tbody>
        </table>
        {{ $managements->onEachSide(1)->links() }}
    @else
        <h4>{{trans("managements.emptyMessage.{$view}")}}</h4>
    @endif
@endsection
