<div class="row">
    {!! Form::formTitle('world', sections('clients.forms.label-region')) !!}

    {{-- Client allowed regions --}}
    <div class="form-group col-12">
        {!! Form::autoCheckBox($relationships['regions']['all'], $relationships['regions']['selected'], $checkBoxName = 'regions', $fieldName = 'region_name') !!}
    </div>
</div>