<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label')) !!}

    {{-- Crop ID --}}
    {{ html()->hidden('crop_id')->value(request('_key')) }}
    
    {{-- Pattern name --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans_title('patterns') }}</label>
        {{ html()->text('pattern_name')->class('form-control')->required() }}
    </div>

    {{-- Pattern name --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('system.reference') }}</label>
        {{ html()->text('pattern_reference')->class('form-control') }}
    </div>

    {{-- Pest description --}}
    <div class="form-group col-12">
        <label class="control-label">{{ trans('system.description') }}</label>
        {!! Form::autoTextArea('pattern_description') !!}
    </div>
</div>