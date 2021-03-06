@extends('layouts.layout')

@section('content')

    @includeWhen($view == 'index', 'project._menu')
    @includeWhen($view == 'trash', 'project._back')

    @if ($projects->isNotEmpty())
        <table class="table table-sm table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('Name')</th>
                <th scope="col">@lang('Description')</th>
                <th scope="col" class="text-center" >@lang('Managements')</th>
                <th scope="col" class="text-center">@lang('Staff')</th>
                <th scope="col" class="text-center">∆ @lang('Wage')</th>
                <th scope="col" class="text-center">@lang('Dates')</th>
                <th scope="col" class="text-center">@lang('Actions')</th>
            </tr>
            </thead>
            <tbody>
                @each('project._row', $projects, 'project')
            </tbody>
        </table>
        {{ $projects->onEachSide(1)->links() }}
    @else
        <h4>{{trans("projects.emptyMessage.{$view}")}}</h4>
    @endif
@endsection
