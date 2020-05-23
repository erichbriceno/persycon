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
            id="min1" 
            name="min1" 
            type="text" 
            class="form-control form-control-sm text-right @error('min1') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}" 
            value="{{ old('min1', $project->cat1->minimum ) }}"
        >
        @error('min1')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="max1" 
            name="max1" 
            type="text" 
            class="form-control form-control-sm text-right @error('max1') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.maximum')}}"
            value="{{ old('max1', $project->cat1->maximum ) }}"
        >
        @error('max1')
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
            id="min2" 
            name="min2" 
            type="text" 
            class="form-control form-control-sm text-right @error('min2') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('min2', $project->cat2->minimum ) }}"
        >
        @error('min2')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="max2" 
            name="max2" 
            type="text" 
            class="form-control form-control-sm text-right @error('max2') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.maximum')}}"
            value="{{ old('max2', $project->cat2->maximum ) }}"
        >
        @error('max2')
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
            id="min3" 
            name="min3" 
            type="text" 
            class="form-control form-control-sm text-right @error('min3') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('min3', $project->cat3->minimum ) }}"
        >
        @error('min3')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="max3" 
            name="max3" 
            type="text" 
            class="form-control form-control-sm text-right @error('max3') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.maximum')}}"
            value="{{ old('max3', $project->cat3->maximum ) }}"
        >
        @error('max3')
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
            id="min4" 
            name="min4" 
            type="text" 
            class="form-control form-control-sm text-right @error('min4') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('min4', $project->cat4->minimum ) }}"
        >
        @error('min4')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-md-3">
        <input 
            id="max4" 
            name="max4" 
            type="text" 
            class="form-control form-control-sm text-right @error('max4') is-invalid @enderror" 
            required 
            placeholder="{{trans('categories.fieldsPlaceholder.minimum')}}"
            value="{{ old('max4', $project->cat4->maximum ) }}"
        >
        @error('max4')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>    
</div>


<div class="row">
    <div class="col-md-10">
        <div class="form-inline justify-content-end">
            <a href="{{ route($back) }}" class="btn btn-sm btn-primary btn-sm">@lang('Back')</a>
            &nbsp;
            <button type="submit" class="btn btn-sm btn-primary btn-sm">
                @lang('Update')
            </button>
        </div>
    </div>
</div>