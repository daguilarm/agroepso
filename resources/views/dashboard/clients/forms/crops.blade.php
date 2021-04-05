<div class="row">
    {!! Form::formTitle('administration::crops', sections('crops.forms.label')) !!}

    {{-- Client crops --}}
    <div class="form-group col-12 col-lg-4 col-xl-3">
        <label class="control-label">{{ trans_title('crops', 'plural') }}</label>
        {{ html()->select('crop_id')->options($crops)->class('form-control') }}
    </div>
</div>
