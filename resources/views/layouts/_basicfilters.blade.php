<form method="get" action="{{ route($module) }}">
    <div class="row row-filters pb-1">
        <div class="col-4">
            <div class="form-inline justify-content">
                <a href="{{ route('people.create') }}" class="btn btn-primary btn-sm">@lang('Incorporate')</a>
                &nbsp;
                <a href="{{ route('people.blacklist') }}" class="btn btn-outline-secondary btn-sm">@lang('Blacklist')</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-inline form-search justify-content-end">
                <div class="btn-group">
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Buscar...">
                </div>
                &nbsp;
                <button type="submit" class="btn btn-sm btn-outline-primary">@lang('Filter') <i class="fas fa-cog"></i></button>
                &nbsp;
                <a href="{{ route('people', ['state' => 'active']) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-times"></i></a>
            </div>
        </div>
    </div>
</form>
