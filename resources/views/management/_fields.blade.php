@csrf

<div class="form-group row">
    <label for="acronym" class="col-md-4 col-form-label text-md-right">@lang('Acronym')</label>
    <div class="col-md-6">
        <input 
            id="acronym" 
            name="acronym" 
            type="text" 
            class="form-control @error('acronym') is-invalid @enderror" 
            required 
            autocomplete="acronym" 
            placeholder ="{{ trans('managements.fieldsPlaceholder.acronym') }}" 
            value="{{ old('acronym', $management->acronym) }}" 
            autofocus
            >
        @error('acronym')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

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
            placeholder ="{{ trans('managements.fieldsPlaceholder.name') }}" 
            value="{{ old('name', $management->name) }}">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="form-inline justify-content-end">
            <a href="{{ route('managements') }}" class="btn btn-sm btn-secondary btn-sm">@lang('Back')</a>
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