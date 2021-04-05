<div class="row">
    {!! Form::formTitle('administration::options', sections('clients.forms.label-options')) !!}

    {{-- Agronomics fields --}}
    <div class="form-group col-12 agronomic-options">
        <h4>{{ trans_title('plots') }}</h4>
        {!! Form::autoCheckBox($relationships['options']['all']['plot'], $relationships['options']['selected'], $checkBoxName = 'options', $fieldName = 'option_name') !!}
    </div>

    {{-- Agronomics fields --}}
    <div class="form-group col-12 agronomic-options">
        <h4>{{ trans_title('crops') }}</h4>
        {!! Form::autoCheckBox($relationships['options']['all']['crop'], $relationships['options']['selected'], $checkBoxName = 'options', $fieldName = 'option_name') !!}
    </div>

    {{-- Agronomics fields --}}
    <div class="form-group col-12 agronomic-options">
        <h4>{{ trans_title('analysis') }}</h4>
        {!! Form::autoCheckBox($relationships['options']['all']['analysis'], $relationships['options']['selected'], $checkBoxName = 'options', $fieldName = 'option_name') !!}
    </div>
</div>