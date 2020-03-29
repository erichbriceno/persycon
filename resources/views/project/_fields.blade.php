@csrf

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">@lang('Name')</label>
    <div class="col-md-4">
        <input id="name" type="text" class="form-control" name="name" required autocomplete="name">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>

    <div class="col-md-2">
        <select name="year" id="year" class="form-control @error('year') is-invalid @enderror">
            <option value="2019">
                2019
            </option>
            <option value="2020">
                2020
            </option>
            <option value="2021">
                2021
            </option>
        </select>
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
        <input id="description" type="text" class="form-control" name="description" required autocomplete="description">
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
            <input type="text" class="form-control form-control-sm text-right" name="from" id="from" placeholder="@lang('Start')" value="{{ request('from') }}">
            @error('from')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="input-group date">
            <input type="text" class="form-control form-control-sm text-right" name="to" id="to" placeholder="@lang('Ending')" value="{{ request('to') }}">
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
                @lang('Save')
            </button>
            &nbsp;
            <a href="{{ route('projects') }}" class="btn btn-sm btn-primary btn-sm">@lang('Back')</a>
        </div>
    </div>
</div>