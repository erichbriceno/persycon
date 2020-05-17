@csrf

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Project')</label>
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
            id="category1_min" 
            name="category1_min" 
            type="text" 
            class="form-control form-control-sm text-right @error('category1_min') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}" 
            value="{{ old('category1_min', $project->cat1->minimum ) }}"
        >
        @error('category1_min')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="category1_max" 
            name="category1_max" 
            type="text" 
            class="form-control form-control-sm text-right @error('category1_max') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.maximum')}}"
            value="{{ old('category1_max', $project->cat1->maximum ) }}"
        >
        @error('category1_max')
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
            id="category2_min" 
            name="category2_min" 
            type="text" 
            class="form-control form-control-sm text-right @error('category2_min') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('category2_min', $project->cat2->minimum ) }}"
        >
        @error('category2_min')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="category2_max" 
            name="category2_max" 
            type="text" 
            class="form-control form-control-sm text-right @error('category2_max') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.maximum')}}"
            value="{{ old('category2_max', $project->cat2->maximum ) }}"
        >
        @error('category2_max')
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
            id="category3_min" 
            name="category3_min" 
            type="text" 
            class="form-control form-control-sm text-right @error('category3_min') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('category3_min', $project->cat3->minimum ) }}"
        >
        @error('category3_min')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="category3_max" 
            name="category3_max" 
            type="text" 
            class="form-control form-control-sm text-right @error('category3_max') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.maximum')}}"
            value="{{ old('category3_max', $project->cat3->maximum ) }}"
        >
        @error('category3_max')
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
            id="category4_min" 
            name="category4_min" 
            type="text" 
            class="form-control form-control-sm text-right @error('category4_min') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('category4_min', $project->cat4->minimum ) }}"
        >
        @error('category4_min')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="category4_max" 
            name="category4_max" 
            type="text" 
            class="form-control form-control-sm text-right @error('category4_max') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('category4_max', $project->cat4->maximum ) }}"
        >
        @error('category4_max')
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