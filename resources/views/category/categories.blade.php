@extends('layouts.layout')

@section('content')

    @if ($projects->isNotEmpty())
        <table class="table table-sm">
            <thead class="thead-light">
            <tr>
                <th scope="col">@lang('Name project')</th>
                <th scope="col" class="text-center" colspan="4" >@lang('Salaries categories')</th>
                <th scope="col" class="text-center">@lang('Actions')</th>
            </tr>
            </thead>
            <tbody>
                @each('category._row', $projects, 'project')
            </tbody>
        </table>
        {{ $projects->onEachSide(1)->links() }}
    @else
        <h4>{{trans("categories.emptyMessage.{$view}")}}</h4>
    @endif
@endsection
