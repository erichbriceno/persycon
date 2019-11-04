
    <form method="get" action="{{ url('users') }}">

        <div class="row row-filters pb-1">
            <div class="col-8">
                @foreach(['' => 'All', 'with_management' => 'With management', 'without_management' => 'Without management'] as $value => $text)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="management"
                           id="management_{{ $value ?: 'all' }}" value="{{ $value }}" {{ $value === request('management','') ? 'checked' : '' }}>
                    <label class="form-check-label" for="management_{{ $value ?: 'all' }}">@lang($text)</label>
                </div>
                @endforeach
            </div>

            <div class="col-4">
                <div class="form-inline justify-content-end">
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">@lang('New user')</a>
                </div>
            </div>
        </div>
        <div class="row row-filters">
            <div class="col-md-5">
                <div class="form-inline form-search">

                    <div class="input-group">
                        <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Buscar...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-cog"></i></button>
                        </div>
                    </div>
                    &nbsp;
{{--                    <div class="drop-skills">--}}
{{--                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            Roles--}}
{{--                        </button>--}}
{{--                        <div class="skills-list">--}}
{{--                            <div class="form-group form-check">--}}
{{--                                <a class="form-check-input" href="#">User</a>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-check">--}}
{{--                                <a class="form-check-input" href="#">Admin</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    &nbsp;
{{--                    <div class="drop-skills">--}}
{{--                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                            Habilidades--}}
{{--                        </button>--}}
{{--                        <div class="skills-list">--}}
{{--                            <div class="form-group form-check">--}}
{{--                                <input type="checkbox" class="form-check-input" id="skill1">--}}
{{--                                <label class="form-check-label" for="skill1">Administrativo</label>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-check">--}}
{{--                                <input type="checkbox" class="form-check-input" id="skill2">--}}
{{--                                <label class="form-check-label" for="skill2">Logístico</label>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-check">--}}
{{--                                <input type="checkbox" class="form-check-input" id="skill3">--}}
{{--                                <label class="form-check-label" for="skill3">Supervisor</label>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-check">--}}
{{--                                <input type="checkbox" class="form-check-input" id="skill4">--}}
{{--                                <label class="form-check-label" for="skill4">Especialista</label>--}}
{{--                            </div>--}}
{{--                            <div class="form-group form-check">--}}
{{--                                <input type="checkbox" class="form-check-input" id="skill5">--}}
{{--                                <label class="form-check-label" for="skill5">Operador</label>--}}
{{--                             </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>

{{--            <div class="col-md-7">--}}
{{--                <div class="form-inline form-dates justify-content-end">--}}
{{--                    <label for="date_start" class="form-label-sm">Fecha</label>--}}
{{--                    &nbsp;--}}
{{--                    <div class="input-group">--}}
{{--                        <input type="text" class="form-control form-control-sm" name="date_start" id="date_start" placeholder="Desde">--}}
{{--                        <div class="input-group-append">--}}
{{--                            <button type="button" class="btn btn-secondary btn-sm"><i class="far fa-calendar-alt"></i></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="input-group">--}}
{{--                        <input type="text" class="form-control form-control-sm" name="date_start" id="date_start" placeholder="Hasta">--}}
{{--                        <div class="input-group-append">--}}
{{--                            <button type="button" class="btn btn-secondary btn-sm"><i class="far fa-calendar-alt"></i></button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    &nbsp;--}}
{{--                    <button type="submit" class="btn btn-sm btn-secondary">Filtrar</button>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </form>
    &nbsp;