@extends('layouts.layout')

@section('title', $title )

@section('content')


    @include('layouts._filters')



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
