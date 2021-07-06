@extends('layouts.layout')

@section('content')

    @includeWhen($view == 'index', 'layouts._basicfilters')
 
    @if ($people->isNotEmpty())
        <table class="table table-sm table-hover">
            <thead class="thead-light">
                <tr>
                    <th scope="col">@lang('Full Name')</th>
                    <th scope="col" class="text-center">@lang('Gener')</th>
                    <th scope="col" class="text-center">@lang('Age')</th>
                    <th scope="col">@lang('Email')</th>
                    <th scope="col"class="text-center">@lang('Actions')</th>
                </tr>
            </thead>
            <tbody>
                @each('people._row', $people, 'people')
            </tbody>
        </table>
        {{ $people->onEachSide(1)->links() }}
    @else
        <h4>{{trans("people.emptyMessage.{$view}")}}</h4>
    @endif
@endsection
