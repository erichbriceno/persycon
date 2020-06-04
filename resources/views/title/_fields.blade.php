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
            placeholder ="{{ trans('titles.fieldsPlaceholder.name') }}" 
            value="{{ old('name', $title->namew) }}" 
            {{ $title->name ? 'readonly' : 'autofocus' }}
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
        <input id="description" name="description" type="text" class="form-control @error('description') is-invalid @enderror" required autocomplete="description" placeholder ="{{ trans('titles.fieldsPlaceholder.description') }}" value="{{ old('description', $title->description) }}">
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>



@if($view === 'edit')
<div class="form-group row">
    <div class="col-md-10">
        <div class="form-inline justify-content-end">
            @foreach(trans('jobtitles.state') as $state => $label )
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="state" id="state_{{ $state }}" value="{{ $state }}" {{ old('state', $title->state        ) == $state ? 'checked' : '' }}>
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
            <a href="{{ route('titles') }}" class="btn btn-sm btn-primary btn-sm">@lang('Back')</a>
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