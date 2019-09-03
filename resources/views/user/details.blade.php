@extends('layouts.layout')

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
                            <label for="role" class="col-md-4 col-form-label text-md-right">@lang('Role')</label>
                            <div class="col-md-6">
                                <input id="role" type="text" readonly class="form-control" name="role" value="{{ $user->role }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 offset-md-8 pb-4">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked>Edit
                            </label>
                            <label class="btn btn-secondary">
                                <input type="radio" name="options" id="option2" autocomplete="off">Back
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection