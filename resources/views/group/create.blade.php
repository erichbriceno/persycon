@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@lang('Create Group')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('group.store') }}">
                        @include('group._fields')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection