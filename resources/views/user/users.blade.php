@extends('layouts.layout')

@section('content')

    @includeWhen($view == 'index', 'layouts._filters')
    @includeWhen($view == 'trash', 'layouts._back')

    @if ($users->isNotEmpty())
        <div class="table-responsive-lg">
            <table class="table table-sm">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#<span class="oi oi-caret-bottom"></span><span class="oi oi-caret-top"></span></th>
                        <th scope="col">@lang('Full Name') <i class="fas fa-angle-double-up"></i><i class="fas fa-angle-double-down"></i></th>
                        <th scope="col">@lang('Email') <i class="fas fa-angle-double-up"></i><i class="fas fa-angle-double-down"></i></th>
                        <th scope="col">@lang('Management') <i class="fas fa-angle-double-up"></i><i class="fas fa-angle-double-down"></i></th>
                        <th scope="col">@lang('Dates')<i class="fas fa-angle-double-up"></i><i class="fas fa-angle-double-down"></th>
                        <th scope="col"class="text-right th-actions pr-3">@lang('Actions')</th>
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
