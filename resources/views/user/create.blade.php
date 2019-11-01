@extends('layouts.layout')

@section('title', $title )

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@lang('Register user')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.create') }}">
                        @include('user._fields')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
