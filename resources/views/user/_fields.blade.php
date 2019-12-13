@csrf

@if($user->id)
<div class="form-group row">
    <label for="id" class="col-md-4 col-form-label text-md-right">@lang('Id')</label>
    <div class="col-md-6">
        <input id="id" type="text" readonly class="form-control" name="id" value="{{ $user->id }}">
    </div>
</div>
@endif

<div class="form-group row">
    <label for="cedule" class="col-md-4 col-form-label text-md-right">@lang('Cedule')</label>
    <div class="col-md-6">
        <input id="cedule" type="text" class="form-control @error('cedule') is-invalid @enderror" name="cedule" value="{{ old('cedule', $user->cedule) }}" {{ $user->cedule ? 'readonly' : 'autofocus' }} placeholder ="{{ trans('users.fields.cedule') }}" required
        >
        @error('cedule')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="names" class="col-md-4 col-form-label text-md-right">@lang('Names')</label>
    <div class="col-md-6">
        <input id="names" type="text" class="form-control" name="names" value="{{ $user->names }}" required autocomplete="names" readonly>
    </div>
</div>

<div class="form-group row">
    <label for="surnames" class="col-md-4 col-form-label text-md-right">@lang('Surnames')</label>
    <div class="col-md-6">
        <input id="surnames" type="text" class="form-control" name="surnames" value="{{ $user->surnames }}" required autocomplete="surnames" readonly>
    </div>
</div>

@if($user->cedule)
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-Mail Address')</label>
    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" placeholder ="{{ trans('users.fields.email') }}" autocomplete="email" required autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="role" class="col-md-4 col-form-label text-md-right">@lang('Role')</label>
    <div class="col-md-6">
        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
            @foreach($roles as $role)
                <option value="{{ $role->id }}"{{ old('role', $user->role_id) == $role->id ? ' selected' : '' }}>
                    @lang($role->name)
                </option>
            @endforeach
        </select>
        @error('role')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="management" class="col-md-4 col-form-label text-md-right">@lang('Management')</label>
    <div class="col-md-6">
        <select name="management" id="management" class="form-control @error('management') is-invalid @enderror">
            <option value="" {{ old('management', $user->management_id) == null ? ' selected' : '' }}>
                @lang('Unassigned')
            </option>
            @foreach($managements as $management)
                <option value="{{ $management->id }}"{{ old('management', $user->management_id) == $management->id ? ' selected' : '' }}>
                    @lang($management->name)
                </option>
            @endforeach
        </select>
        @error('management')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">@lang('Password')</label>
    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder ="{{ trans('users.fields.password') }}">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">@lang('Confirm Password')</label>
    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
    </div>
</div>

<div class="form-group row">
    <div class="col-md-10">
        <div class="form-inline justify-content-end">
            @foreach(trans('users.state') as $state => $label )
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="state" id="state_{{ $state }}" value="{{ $state }}" {{ old('state', $user->state) == $state ? 'checked' : '' }}>
                <label class="form-check-label" for="state_{{ $state }}" >{{ $label }}</label>
            </div>
            @endforeach
        </div>
        <div class="form-inline justify-content-end">
            @error('state')
                <span class="text-danger">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

    </div>
</div>
@endif

<div class="row">
    <div class="col-md-10">
        <div class="form-inline justify-content-end">
            <button type="submit" class="btn btn-sm btn-primary btn-sm">
                @lang($user->cedule ? 'Save' : 'Find')
            </button>
            &nbsp;
            <a href="{{ route($user->cedule ? 'user.find' : 'users') }}" class="btn btn-sm btn-primary btn-sm">@lang('Back')</a>
        </div>
    </div>
</div>