@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@lang('Register user')</div>

                <div class="card-body">
                    @if($user->cedule)
                        <form method="POST" action="{{ route('user.store') }}">
                    @else
                        <form method="POST" action="{{ route('user.finder') }}">
                    @endif
                        @include('user._fields')
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
