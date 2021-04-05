<div class="row">
    {!! Form::formTitle('info', sections($section . '.forms.label')) !!}

    {{-- City --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">@lang('persona.contact.city')</label>
        {{ html()->text('city_name')->class('form-control')->required() }}
    </div>

    {{-- INE code --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">@lang('geolocation.ine')</label>
        {{ html()->text('ine_id')->class('form-control') }}
    </div>

    {{-- Latitud --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">@lang('geolocation.lat')</label>
        {{ html()->text('city_lat')->class('form-control')->required() }}
    </div>

    {{-- Longitud --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">@lang('geolocation.lng')</label>
        {{ html()->text('city_lng')->class('form-control')->required() }}
    </div>
</div>