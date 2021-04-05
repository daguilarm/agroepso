<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label')) !!}

    {{-- Crop ID --}}
    {{ html()->hidden('crop_id')->value(request('_key')) }}

    {{-- Crop variety --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans_title('crop_varieties') }}</label>
        {{ html()->text('crop_variety_name')->class('form-control')->required() }}
    </div>

    {{-- Crop name --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans_title('crops') }}</label>
        {{ html()->text('crop_name')->value($crop->crop_name)->class('form-control')->disabled() }}
    </div>

    {{-- Crop variety type --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans_title('crop_varieties') }}</label>
        {{ html()->select('crop_variety_type')->class('form-control')->options(configuration('crop_variety_types', $emptyField = true)) }}
    </div>
</div>