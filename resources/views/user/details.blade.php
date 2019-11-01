@extends('layouts.layout')

@section('title', $title )

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('User Details')</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">@lang('First Name')</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" readonly class="form-control" name="first_name" value="{{ $user->first_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">@lang('Last Name')</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" readonly class="form-control" name="last_name" value="{{ $user->last_name }}">
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
                                <input id="role_id" type="text" readonly class="form-control" name="role_id" value="@lang($user->role->description)">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="management_id" class="col-md-4 col-form-label text-md-right">@lang('Management')</label>
                            <div class="col-md-6">
                                <input id="management_id" type="text" readonly class="form-control" name="management_id" value="@lang($user->management->name)">
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