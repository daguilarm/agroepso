<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label')) !!}

    {{-- Crop ID --}}
    {{ html()->hidden('crop_id')->value(request('_key')) }}

    {{-- Pest name --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans_title('pests') }}</label>
        {{ html()->text('pest_name')->class('form-control')->required() }}
    </div>

    {{-- Pest description --}}
    <div class="form-group col-12">
        <label class="control-label">{{ trans('system.description') }}</label>
        {!! Form::autoTextArea('pest_description') !!}
    </div>
</div>