<div class="row">
    {!! Form::formTitle('administration::modules', sections($section . '.forms.label')) !!}

    {{-- Module --}}
    <div class="form-group col-12 col-lg-4">
        <label class="control-label">{{ trans_title('modules') }}</label>
        {{ html()->text('module_name')->class('form-control')->required() }}
    </div>

    {{-- Module key --}}
    <div class="form-group col-12 col-lg-4">
        <label class="control-label">{{ sections('modules.key') }}</label>
        {{ html()->text('module_key')->class('form-control')->required() }}
    </div>

    {{-- Module description --}}
    <div class="form-group col-12">
        <label class="control-label">{{ trans('system.description') }}</label>
        {!! Form::autoTextArea('module_description') !!}
    </div>
</div>