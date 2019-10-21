@extends('layouts.layout')

@section('title', $title )

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Detalles del Usuario</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Name')</label>
                            <div class="col-md-6">
                                <input id="name" type="text" readonly class="form-control" name="name" value="{{ $user->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-Mail Address')</label>
                            <div class="col-md-6">
                                <input id="email" type="email" readonly class="form-control" name="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right">@lang('Role')</label>
                            <div class="col-md-6">
                                <input id="role_id" type="text" readonly class="form-control" name="role" value="{{ $user->role->description }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-inline justify-content-end">
                                    <a href="{{ route('user.edit', ['id' => $user->id]) }}" class="btn btn-sm btn-secondary" role="button" aria-disabled="true">Edit</a>
                                    &nbsp;
                                    <a href="{{ route('users') }}" class="btn btn-sm btn-secondary" role="button" aria-disabled="true">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection