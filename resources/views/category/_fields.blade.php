@csrf

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Name project')</label>
    <div class="col-md-6">
        <input 
            id="name" 
            name="name" 
            type="text" 
            class="form-control @error('name') is-invalid @enderror" 
            required 
            value="{{ old('name', $project->name) }}" 
            readonly
            >
    </div>
</div>

<div class="form-group row">
    <div class="col-md-3 text-center offset-md-4">
        <div class="bg-secondary p-1">
            <span class="font-weight-light text-white">@lang('Minimum')</span>    
        </div>
    </div>
    <div class="col-md-3 text-center">
        <div class="bg-secondary p-1">
            <span class="font-weight-normal text-white">@lang('Maximum')</span>
        </div>
    </div>    
</div>

<div class="form-group row">
    <label for="category1" class="col-md-4 col-form-label text-md-right">@lang('Category') 1</label>
    <div class="col-md-3">
        <input 
            id="category1-min" 
            name="category1-min" 
            type="text" 
            class="form-control form-control-sm text-right @error('category1-min') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}" 
            value="{{ old('category1-min', $project->cat1->minimum ) }}"
        >
        @error('category1-min')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="category1-max" 
            name="category1-max" 
            type="text" 
            class="form-control form-control-sm text-right @error('category1-max') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.maximum')}}"
            value="{{ old('category1-max', $project->cat1->maximum ) }}"
        >
        @error('category1-max')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>    
</div>

<div class="form-group row">
    <label for="category2" class="col-md-4 col-form-label text-md-right">@lang('Category') 2</label>
    <div class="col-md-3">
        <input 
            id="category2-min" 
            name="category2-min" 
            type="text" 
            class="form-control form-control-sm text-right @error('category2-min') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('category2-min', $project->cat2->minimum ) }}"
        >
        @error('category2-min')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="category2-max" 
            name="category2-max" 
            type="text" 
            class="form-control form-control-sm text-right @error('category2-max') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.maximum')}}"
            value="{{ old('category2-max', $project->cat2->maximum ) }}"
        >
        @error('category2-max')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>    
</div>

<div class="form-group row">
    <label for="category3" class="col-md-4 col-form-label text-md-right">@lang('Category') 3</label>
    <div class="col-md-3">
        <input 
            id="category3-min" 
            name="category3-min" 
            type="text" 
            class="form-control form-control-sm text-right @error('category3-min') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('category3-min', $project->cat3->minimum ) }}"
        >
        @error('category3-min')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="category3-max" 
            name="category3-max" 
            type="text" 
            class="form-control form-control-sm text-right @error('category3-max') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.maximum')}}"
            value="{{ old('category3-max', $project->cat3->maximum ) }}"
        >
        @error('category3-max')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>    
</div>

<div class="form-group row">
    <label for="category4" class="col-md-4 col-form-label text-md-right">@lang('Category') 4</label>
    <div class="col-md-3">
        <input 
            id="category4-min" 
            name="category4-min" 
            type="text" 
            class="form-control form-control-sm text-right @error('category4-min') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('category4-min', $project->cat4->minimum ) }}"
        >
        @error('category4-min')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="category4-max" 
            name="category4-max" 
            type="text" 
            class="form-control form-control-sm text-right @error('category4-max') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('category4-max', $project->cat4->maximum ) }}"
        >
        @error('category4-max')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>    
</div>


<div class="row">
    <div class="col-md-10">
        <div class="form-inline justify-content-end">
            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary btn-sm">@lang('Back')</a>
            &nbsp;
            <button type="submit" class="btn btn-sm btn-primary btn-sm">
                @lang('Update')
            </button>
        </div>
    </div>
</div>