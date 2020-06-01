@extends('layouts.layout')

@section('content')

    @includeWhen($view == 'index', 'title._menu')
    @includeWhen($view == 'trash', 'title._back')

    @if ($titles->isNotEmpty())
        <table class="table table-sm table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">@lang('Name')</th>
                <th scope="col">@lang('Description')</th>
                <th scope="col" class="text-center" >@lang('Management')</th>
                <th scope="col" class="text-center" >@lang('Category')</th>
                <th scope="col" class="text-center" >@lang('Type')</th>
                <th scope="col" class="text-center" >@lang('Salary')</th>
                <th scope="col" class="text-center">@lang('Actions')</th>
            </tr>
            </thead>
            <tbody>
                @each('title._row', $titles, 'title')
            </tbody>
        </table>
        {{ $titles->onEachSide(1)->links() }}
    @else
        <h4>{{trans("titles.emptyMessage.{$view}")}}</h4>
    @endif
@endsection
