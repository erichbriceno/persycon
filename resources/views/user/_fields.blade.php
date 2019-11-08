@csrf
<div class="form-group row">
    <label for="names" class="col-md-4 col-form-label text-md-right">@lang('Names')</label>

    <div class="col-md-6">
        <input id="names" type="text" class="form-control @error('Names') is-invalid @enderror" name="names" value="{{ old('names', $user->names) }}" required autocomplete="names" autofocus>
        @error('names')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="surnames" class="col-md-4 col-form-label text-md-right">@lang('Surnames')</label>
    <div class="col-md-6">
        <input id="surnames" type="text" class="form-control @error('Surnames') is-invalid @enderror" name="surnames" value="{{ old('surnames', $user->surnames) }}" required autocomplete="surnames" autofocus>
        @error('surnames')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-Mail Address')</label>
    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="role_id" class="col-md-4 col-form-label text-md-right">@lang('Role')</label>
    <div class="col-md-6">
        <select name="role_id" id="role_id" class="form-control">
            @foreach($roles as $role)
                <option value="{{ $role->id }}"{{ old('role_id', $user->role_id) == $role->id ? ' selected' : '' }}>
                    @lang($role->description)
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="management_id" class="col-md-4 col-form-label text-md-right">@lang('Management')</label>
    <div class="col-md-6">
        <select name="management_id" id="management_id" class="form-control">
            <option value="" {{ old('management_id', $user->management_id) == null ? ' selected' : '' }}>
                @lang('Unassigned')
            </option>
            @foreach($managements as $management)
                    <option value="{{ $management->id }}"{{ old('management_id', $user->management_id) == $management->id ? ' selected' : '' }}>
                        @lang($management->name)
                    </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">@lang('Password')</label>
    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
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

<div class="row">
    <div class="col-md-10">
        <div class="form-inline justify-content-end">
            <button type="submit" class="btn btn-sm btn-primary btn-sm">
                @lang('Save')
            </button>
            &nbsp;
            <a href="{{ route('users') }}" class="btn btn-sm btn-primary btn-sm">@lang('Back')</a>
        </div>
    </div>
</div>