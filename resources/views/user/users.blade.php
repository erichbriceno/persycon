@extends('layouts.layout')

@section('content')

    @includeWhen($view == 'index', 'layouts._filters')
    @includeWhen($view == 'trash', 'layouts._back')

    @if ($users->isNotEmpty())
        <div class="table-responsive-lg">
            <table class="table table-sm table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"><a href="{{ $sortable->url('cedule') }}" class="indecorate">@lang('Cedule')</a>&nbsp<i class="fas {{ $sortable->classes('cedule') }}"></i></th>
                        <th scope="col"><a href="{{ $sortable->url('names') }}" class="indecorate">@lang('Full Name')</a>&nbsp<i class="fas {{ $sortable->classes('names') }}"></i></th>
                        <th scope="col"><a href="{{ $sortable->url('email') }}" class="indecorate">@lang('Email')</a>&nbsp<i class="fas {{ $sortable->classes('email') }}"></i></th>
                        <th scope="col">@lang('Management')</th>
                        <th scope="col"><a href="{{ $sortable->url('date') }}" class="indecorate">@lang('Dates')</a>&nbsp<i class="fas {{ $sortable->classes('date') }}"></i></th>
                        <th scope="col"class="text-center">@lang('Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @each('user._row', $users, 'user')
                </tbody>
            </table>
        </div>
        {{ $users->onEachSide(1)->links() }}
    @else
        <h4>{{trans("users.emptyMessage.{$view}")}}</h4>
    @endif
@endsection
