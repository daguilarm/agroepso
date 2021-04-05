<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label-crop')) !!}

    {{-- Only for Admins --}}
    @role('admin')
        {{-- Crop --}}
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ trans_title('crops') }}</label>
            {{ html()->text('crop_name')->class('form-control')->value(isset($data) ? optional($data->crop)->crop_name : null)->disabled()->required() }}
            {{ html()->hidden('crop_id') }}
        </div>

    {{-- Rest of users --}}
    @else
        {{-- Crop --}}
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ trans_title('crops') }}</label>
            {{ html()->text('crop_name')->class('form-control')->value(Credentials::cropName())->disabled()->required() }}
            {{ html()->hidden('crop_id')->value(Credentials::crop()) }}
        </div>
    @endrole

    {{-- Crop variety --}}
    @if(getClient('option.crop-variety'))
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ trans_title('crop_varieties') }}</label>
            {!! Form::selectCropVarieties($data ?? null) !!}
        </div>
    @endif

    {{-- Plot date --}}
    @if(getClient('option.plot-date'))
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ sections('plots.start_date') }}</label>
            {{ html()->text('plot_start_date')->class('form-control year') }}
        </div>
    @endif

    <div class="col-12"><hr></div>

    {{-- Plot training --}}
    @if(getClient('option.crop-training'))
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ sections('plots.training') }}</label>
            {{ html()->select('plot_crop_training')->options(selectTraining())->class('form-control') }}
        </div>
    @endif

    {{-- Plot green cover --}}
    @if(getClient('option.crop-green'))
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ sections('plots.green_cover') }}</label>
            {{ html()->select('plot_green_cover')->options(selectBoolean())->class('form-control') }}
        </div>
    @endif
</div>
