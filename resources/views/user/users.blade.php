@extends('layouts.layout')

@section('content')

    @includeWhen($view == 'index', 'layouts._filters')
    @includeWhen($view == 'trash', 'layouts._back')

    @if ($users->isNotEmpty())
        <div class="table-responsive-lg">
            <table class="table table-sm">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"><a href="{{ $sortable->url('id') }}">@lang('ID')</a>&nbsp<i class="fas {{ $sortable->classes('id') }}"></i></th>
                        <th scope="col"><a href="{{ $sortable->url('names') }}">@lang('Full Name')</a>&nbsp<i class="fas {{ $sortable->classes('names') }}"></i></th>
                        <th scope="col"><a href="{{ $sortable->url('email') }}">@lang('Email')</a>&nbsp<i class="fas {{ $sortable->classes('email') }}"></i></th>
                        <th scope="col"><a href="{{ $sortable->url('management') }}">@lang('Management')</a>&nbsp<i class="fas {{ $sortable->classes('management') }}"></i></th>
                        <th scope="col"><a href="{{ $sortable->url('create_at') }}">@lang('Dates')</a>&nbsp<i class="fas {{ $sortable->classes('create_at') }}"></i></th>
                        <th scope="col"class="text-right th-actions pr-4">@lang('Actions')</th>
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
