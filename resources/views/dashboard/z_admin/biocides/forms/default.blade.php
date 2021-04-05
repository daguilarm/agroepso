<div class="row">
    {!! Form::formTitle('administration::biocides', sections($section . '.forms.label')) !!}

    {{-- Biocide num --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('biocides.register') }}</label>
        {{ html()->text('biocide_num')->class('form-control')->required() }}
    </div>
    {{-- Biocide name --}}
    <div class="form-group col-12 col-lg-5">
        <label class="control-label">{{ trans_title('biocides') }}</label>
        {{ html()->text('biocide_name')->class('form-control')->required() }}
    </div>
    {{-- Biocide company --}}
    <div class="form-group col-12 col-lg-5">
        <label class="control-label">{{ trans('financials.company') }}</label>
        {{ html()->text('biocide_company')->class('form-control')->required() }}
    </div>
    {{-- Biocide formula --}}
    <div class="form-group col-12">
        <label class="control-label">{{ sections('biocides.formula') }}</label>
        {!! Form::autoTextArea('biocide_formula', $required = true) !!}
    </div>
</div>