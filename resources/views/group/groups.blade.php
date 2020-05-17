@extends('layouts.layout')

@section('content')

    @includeWhen($view == 'index', 'group._menu')
    @includeWhen($view == 'trash', 'group._back')

    @if ($groups->isNotEmpty())
        <table class="table table-sm table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">@lang('Name')</th>
                <th scope="col">@lang('Description')</th>
                <th scope="col">@lang('Coordination')</th>
                <th scope="col" class="text-center">@lang('Staff')</th>
                <th scope="col" class="text-center">@lang('Status')</th>
                <th scope="col" class="text-center">@lang('Actions')</th>
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
