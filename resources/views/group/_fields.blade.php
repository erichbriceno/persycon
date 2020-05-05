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
            placeholder ="{{ trans('groups.fieldsPlaceholder.name') }}" 
            value="{{ old('name', $group->name) }}" 
            autofocus
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
            placeholder ="{{ trans('groups.fieldsPlaceholder.description') }}"
            value="{{ old('description', $group->description) }}"
            >
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="coordination" class="col-md-4 col-form-label text-md-right">@lang('Coordination')</label>
    <div class="col-md-6">
        <select name="coordination" id="coordination" class="form-control @error('coordination') is-invalid @enderror">
            <option>
                @lang('Select coordination')
            </option>
            @foreach($coordinations as $coordination)
                <option value="{{ $coordination->id }}"{{ old('coordination', $group->coordination_id) == $coordination->id ? ' selected' : '' }}>
                    @lang($coordination->name)
                </option>
            @endforeach
        </select>
        @error('coordination')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="form-inline justify-content-end">
            <a href="{{ route('groups') }}" class="btn btn-sm btn-primary btn-sm">@lang('Back')</a>
            &nbsp;
            <button type="submit" class="btn btn-sm btn-primary btn-sm">
                @if($view == 'create')
                    @lang('Save')
                @else
                    @lang('Update')
                @endif
            </button>
        </div>
    </div>
</div>