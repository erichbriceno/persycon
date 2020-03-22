@extends('layouts.layout')

@section('content')

    <div class="row row-filters pb-1">
        <div class="col-12">
            <div class="form-inline justify-content-end">
                <a href="#" class="btn btn-outline-secondary btn-sm">@lang('Trash')</a>
                &nbsp;
                <a href="{{ route('project.create') }}" class="btn btn-primary btn-sm">@lang('Create Project')</a>
            </div>
        </div>
    </div>
    @if ($projects->isNotEmpty())
        <table class="table table-sm">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('Name')</th>
                <th scope="col">@lang('Description')</th>
                <th colspan="4" scope="col" class="text-center">@lang('Hired')</th>
                <th scope="col" class="text-center">@lang('Dates')</th>
                <th scope="col" class="text-center">@lang('Actions')</th>
            </tr>
            </thead>
            <tbody>
                @each('project._row', $projects, 'project')
            </tbody>
        </table>
        {{ $projects->onEachSide(1)->links() }}
    @else
        <h4>{{trans('projects.emptyMessage.index')}}</h4>
    @endif
@endsection
