@extends('layouts.layout')

@section('content')

    <div class="d-flex justify-content-between align-items-end mb-3">
        <p>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">@lang('New user')</a>
        </p>
    </div>

    @if ($users->isNotEmpty())

    <div class="table-responsive-lg">
        <table class="table table-sm">
            <thead class="thead-light">
            <tr>
                <th scope="col">#<span class="oi oi-caret-bottom"></span><span class="oi oi-caret-top"></span></th>
                <th scope="col">@lang('Full Name') <i class="fas fa-angle-double-up"></i><i class="fas fa-angle-double-down"></i></th>
                <th scope="col">@lang('Email') <i class="fas fa-angle-double-up"></i><i class="fas fa-angle-double-down"></i></th>
                <th scope="col">@lang('Role') <i class="fas fa-angle-double-up"></i><i class="fas fa-angle-double-down"></i></th>
                <th scope="col"class="text-center th-actions">Acciones</th>
            </tr>
            </thead>
            <tbody>
                @each('user._row', $users, 'user')
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
    @else
        <p>@lang('There are no registered users')</p>
    @endif
@endsection
