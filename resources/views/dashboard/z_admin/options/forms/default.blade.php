<div class="row">
    {!! Form::formTitle('administration::options', sections($section . '.forms.label')) !!}

    {{-- Option name --}}
    <div class="form-group col-12 col-lg-4">
        <label class="control-label">{{ trans_title('options') }}</label>
        {{ html()->text('option_name')->class('form-control')->required() }}
    </div>

    {{-- Option description --}}
    <div class="form-group col-12 col-lg-8">
        <label class="control-label">{{ trans('system.description') }}</label>
        {{ html()->text('option_description')->class('form-control') }}
    </div>

    {{-- Option key --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('options.key') }}</label>
        {{ html()->text('option_key')->class('form-control')->required() }}
    </div>

    {{-- Option category --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ trans('system.category') }}</label>
        {{ html()->text('option_category')->class('form-control')->required() }}
    </div>
</div>