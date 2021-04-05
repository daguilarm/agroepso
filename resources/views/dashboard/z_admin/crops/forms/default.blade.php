<div class="row">
    {!! Form::formTitle('administration::crops', sections($section . '.forms.label')) !!}

    {{-- Crop name --}}
    <div class="form-group col-12 col-lg-4">
        <label class="control-label">{{ trans_title('crops') }}</label>
        {{ html()->text('crop_name')->class('form-control')->required() }}
    </div>

    {{-- Crop description --}}
    <div class="form-group col-12 col-lg-4">
        <label class="control-label">{{ sections('crops.key') }}</label>
        {{ html()->text('crop_key')->class('form-control')->required() }}
    </div>

    {{-- Crop description --}}
    <div class="form-group col-12">
        <label class="control-label">{{ trans('system.description') }}</label>
        {!! Form::autoTextArea('crop_description') !!}
    </div>
</div>