@csrf

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Name')</label>
    <div class="col-md-4">
        <input 
            id="name" 
            name="name" 
            type="text" 
            class="form-control @error('name') is-invalid @enderror" 
            required 
            autocomplete="name" 
            placeholder ="{{ trans('projects.fieldsPlaceholder.name') }}" 
            value="{{ old('name', $project->namew) }}" 
            {{ $project->namew ? 'readonly' : 'autofocus' }}
            >
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="col-md-2">
            @if($project->year)
                <input type="text" class="form-control @error('year') is-invalid @enderror" value="{{ old('year', $project->year) }}" readonly>
            @else
                <select id="year" name="year" class="form-control @error('year') is-invalid @enderror">
                    @foreach($years as $year)
                        <option value="{{ $year }}"{{ old('year', $project->year??today()->format('Y') ) == $year ? ' selected' : '' }}>
                            @lang($year)
                        </option>
                    @endforeach
                </select>
            @endif
        
        @error('year')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right">@lang('Description')</label>
    <div class="col-md-6">
        <input id="description" name="description" type="text" class="form-control @error('description') is-invalid @enderror" required autocomplete="description" placeholder ="{{ trans('projects.fieldsPlaceholder.description') }}" value="{{ old('description', $project->description) }}">
        @error('description')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="dates" class="col-md-4 col-form-label text-md-right">@lang('Date')</label>
                
    <div class="col-md-3">
        <div class="input-group date">
            <input id="from" name="from" type="text" class="form-control form-control-sm text-right @error('from') is-invalid @enderror" required placeholder="@lang('Start')" value="{{ old('from', $project->start?$project->start->format('d/m/Y'):'') }}">
            @error('from')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="input-group date">
            <input id="to" name="to" type="text" class="form-control form-control-sm text-right @error('to') is-invalid @enderror" placeholder="@lang('Ending')" value="{{ old('to', $project->ending?$project->ending->format('d/m/Y'):'') }}">
            @error('to')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-10">
        <div class="form-inline justify-content-end">
            <button type="submit" class="btn btn-sm btn-primary btn-sm">
                @if($view == 'create')
                    @lang('Save')
                @else
                    @lang('Update')
                @endif
            </button>
            &nbsp;
            <a href="{{ route('projects') }}" class="btn btn-sm btn-primary btn-sm">@lang('Back')</a>
        </div>
    </div>
</div>