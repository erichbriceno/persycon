@extends('layouts.layout')

@section('content')

    @includeWhen($view == 'index', 'management._menu')
    @includeWhen($view == 'trash', 'management._back')
    
    @if ($managements->isNotEmpty())
        <table class="table table-sm">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('Name')</th>
                <th scope="col">@lang('Description')</th>
                <th scope="col" class="text-center">@lang('Groups')</th>
                <th colspan="4" scope="col" class="text-center">@lang('Staff')</th>
                <th colspan="3" scope="col" class="text-center">@lang('Status')</th>
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
