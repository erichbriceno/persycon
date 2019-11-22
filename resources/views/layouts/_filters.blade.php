<form method="get" action="{{ route('users') }}">

    <div class="row row-filters pb-1">
        <div class="col-8">
            @foreach(trans('users.filters.states') as $value => $text)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="state"
                       id="state_{{ $value }}" value="{{ $value }}" {{ $value === request('state','all') ? 'checked' : '' }}>
                <label class="form-check-label" for="state{{ $value }}">{{ $text }}</label>
            </div>
            @endforeach
        </div>

        <div class="col-4">
            <div class="form-inline justify-content-end">
                <a href="{{ route('users.trash') }}" class="btn btn-outline-secondary btn-sm">@lang('Trash')</a>
                &nbsp;
                <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm">@lang('New user')</a>
            </div>
        </div>
    </div>

    <div class="row row-filters">
        <div class="col-md-5">
            <div class="form-inline form-search">
                <div class="btn-group">
                    <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Buscar...">
                </div>
                &nbsp;
                <div class="btn-group drop-skills">
                    <select name="management" id="management" class=" btn-secondary btn-sm select-field form-control-sm erich">
                        <option value=""{{ empty(request('management')) ? 'selected' : ''  }}>
                            @lang('All')
                        </option>
                        @foreach($managements as $management)
                            <option value="{{ $management->name }}"{{ request('management') === $management->name ? 'selected' : ''  }}>
                                {{ $management->name }}
                            </option>
                        @endforeach
                        <option value="Unassigned" {{ request('management') === 'Unassigned' ? 'selected' : ''  }}>
                            @lang('Unassigned')
                        </option>
                    </select>
                </div>
                &nbsp;
                <div class="btn-group drop-skills">
                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @lang('Roles')
                    </button>
                    <div class="drop-menu skills-list">
                        @foreach($roles as $role)
                            <div class="form-group form-check">
                                <input name="roles[]"
                                       type="checkbox"
                                       class="form-check-input"
                                       id="role_{{ $role->id }}"
                                       value="{{ $role->name }}"
                                        {{ $checkedRoles->contains($role->name) ? 'checked' : '' }}>
                                <label class="form-check-label" for="role_{{ $role->id }}">@lang($role->name)</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="form-inline form-dates justify-content-end">
                <label for="from" class="form-label-sm">@lang('Dates')</label>&nbsp
                <snap><i class="far fa-calendar-alt"></i></snap>
                &nbsp;
                <div class="input-group date">
                    <input type="text" class="form-control form-control-sm text-right" name="from" id="from" placeholder="@lang('From')" value="{{ request('from') }}">
                </div>
                <div class="input-group date">
                    <input type="text" class="form-control form-control-sm text-right" name="to" id="to" placeholder="@lang('To')" value="{{ request('to') }}">
                </div>
                &nbsp;
                <button type="submit" class="btn btn-sm btn-outline-secondary">@lang('Filter') <i class="fas fa-cog"></i></button>
                &nbsp;
                <a href="{{ route('users') }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-times"></i></a>
            </div>
        </div>
    </div>
</form>
&nbsp;
