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
        <input id="cedule" type="text"  class="form-control @error('Cedule') is-invalid @enderror" name="cedule" value="{{ $user->cedule }}" {{ $user->cedule === '' ? 'autofocus' : 'readonly'  }}>
        @error('Cedule')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="names" class="col-md-4 col-form-label text-md-right">@lang('Names')</label>
    <div class="col-md-6">
        <input id="names" type="text" class="form-control" name="names" value="{{ old('names', $user->names) }}" required autocomplete="names" readonly>
    </div>
</div>

<div class="form-group row">
    <label for="surnames" class="col-md-4 col-form-label text-md-right">@lang('Surnames')</label>
    <div class="col-md-6">
        <input id="surnames" type="text" class="form-control" name="surnames" value="{{ old('surnames', $user->surnames) }}" required autocomplete="surnames" readonly>
    </div>
</div>

@if($user->cedule)
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-Mail Address')</label>
    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus>
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
                    @lang($role->name)
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

<div class="form-group row">
    <div class="col-md-10">
        <div class="form-inline justify-content-end">
            @foreach(trans('users.state') as $state => $label )
            <div class="form-check form-check-inline">
                <input class="form-check-input"
                       type="radio"
                       name="state"
                       id="state_{{ $state }}"
                       value="{{ $state }}"
                       {{ old('state', $user->state) == $state ? 'checked' : '' }}>
                <label class="form-check-label" for="state_{{ $state }}" >{{ $label }}</label>
            </div>
            @endforeach
        </div>
        @error('state')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@endif
<div class="row">
    <div class="col-md-10">
        <div class="form-inline justify-content-end">
            <button type="submit" class="btn btn-sm btn-primary btn-sm">
                @if($user->cedule)
                    @lang('Save')
                @else
                    @lang('Find')
                @endif
            </button>
            &nbsp;
            <a href="{{ route('users') }}" class="btn btn-sm btn-primary btn-sm">@lang('Back')</a>
        </div>
    </div>
</div>