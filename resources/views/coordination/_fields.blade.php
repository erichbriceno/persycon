@csrf

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Name')</label>
    <div class="col-md-6">
        <input 
            id="name" 
            name="name" 
            type="text" 
            class="form-control @error('name') is-invalid @enderror" 
            required 
            autocomplete="name" 
            placeholder ="{{ trans('coordinations.fieldsPlaceholder.name') }}" 
            value="{{ old('name', $coordination->namew) }}" 
            {{ $coordination->name ? 'readonly' : 'autofocus' }}
            >
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right">@lang('Description')</label>
    <div class="col-md-6">
        <input 
            id="description"
            name="description"
            type="text"
            class="form-control @error('description') is-invalid @enderror"
            required 
            autocomplete="description"
            placeholder ="{{ trans('coordinations.fieldsPlaceholder.description') }}"
            value="{{ old('description', $coordination->description) }}"
            >
        @error('description')
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
            <option value="" {{ old('management', $coordination->management_id) == null ? ' selected' : '' }}>
                @lang('Unassigned')
            </option>
            @foreach($managements as $management)
                <option value="{{ $management->id }}"{{ old('management', $coordination->management_id) == $management->id ? ' selected' : '' }}>
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