@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">@lang('Edit Coordination')</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('coordination.update', ['coordination' => $coordination]) }}">
                        @method('PUT')
                        @include('coordination._fields')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection