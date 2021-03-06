@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">@lang('User details')</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">@lang('Id')</label>
                            <div class="col-md-6">
                                <input id="id" type="text" readonly class="form-control" name="id" value="{{ $user->id }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cedule" class="col-md-4 col-form-label text-md-right">@lang('Cedule')</label>
                            <div class="col-md-6">
                                <input id="cedule" type="text" readonly class="form-control" name="cedule" value="{{ $user->cedule }}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="names" class="col-md-4 col-form-label text-md-right">@lang('Names')</label>
                            <div class="col-md-6">
                                <input id="names" type="text" readonly class="form-control" name="names" value="{{ $user->names }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surnames" class="col-md-4 col-form-label text-md-right">@lang('Surnames')</label>
                            <div class="col-md-6">
                                <input id="surnames" type="text" readonly class="form-control" name="surnames" value="{{ $user->surnames }}">
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
                                <input id="role_id" type="text" readonly class="form-control" name="role_id" value="@lang($user->role->name)">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="management_id" class="col-md-4 col-form-label text-md-right">@lang('Management')</label>
                            <div class="col-md-6">
                                <input id="management_id" type="text" readonly class="form-control" name="management_id" value="@lang($user->management->name)">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">@lang('State')</label>
                            <div class="col-md-6">
                                <input id="state" type="text" readonly class="form-control" name="state" value="@lang($user->state)">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-inline justify-content-end">
                                    <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-secondary" role="button" aria-disabled="true">@lang('Edit')</a>
                                    &nbsp;
                                    <a href="{{ route('users', ['state' => 'active']) }}" class="btn btn-sm btn-secondary" role="button" aria-disabled="true">@lang('Back')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection