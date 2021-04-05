{{-- Only Admins can change the client --}}
{!! Form::selectClients($data ?? null, $withCrops = false, 'plant') !!}

{{-- Code --}}
<div class="form-group col-12 col-lg-2">
    <label class="control-label">{{ trans('system.code') }}</label>
    {!! Form::autoIncrement('plant', $data) !!}
    <small id="helpBlock" class="form-text text-muted">@lang('system.code-text')</small>
</div>

{{-- Latitude --}}
<div class="form-group col-12 col-lg-2">
    <label class="control-label">{{ trans('geolocation.lat') }}</label>
    {{ html()->text('plant_lat')->class('form-control decimal') }}
</div>

{{-- Longitud --}}
<div class="form-group col-12 col-lg-2">
    <label class="control-label">{{ trans('geolocation.lng') }}</label>
    {{ html()->text('plant_lng')->class('form-control decimal') }}
</div>
