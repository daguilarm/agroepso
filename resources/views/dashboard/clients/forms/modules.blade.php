<div class="row">
    {!! Form::formTitle('administration::modules', sections('clients.forms.label-module')) !!}

    {{-- Client allowed modules --}}
    <div class="form-group col-12">
        {!! Form::autoCheckBox($relationships['modules']['all'], $relationships['modules']['selected'], $checkBoxName = 'modules', $fieldName = 'module_name') !!}
    </div>
</div>