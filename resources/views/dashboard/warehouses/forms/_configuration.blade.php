{{-- Only Admins can change the client --}}
{!! Form::selectClients($data ?? null, $withCrops = false, 'warehouse') !!}

{{-- Plant --}}
{{-- Only Admins can change the plant --}}
@hasanyrole('admin|dop')
    <div class="form-group col-12 col-lg-4">
        <label class="control-label">{{ trans_title('plants') }}</label>
        {!! Form::selectPlants($data ?? null) !!}
    </div>
@else
    {{ html()->hidden('plant_id', auth()->user()->plant_id)->class('form-control') }}
@endhasanyrole

{{-- Code --}}
<div class="form-group col-12 col-lg-2">
    <label class="control-label">{{ trans('system.code') }}</label>
    {!! Form::autoIncrement('warehouse', $data) !!}
    <small id="helpBlock" class="form-text text-muted">@lang('system.code-text')</small>
</div>

{{-- Latitude --}}
<div class="form-group col-12 col-lg-2">
    <label class="control-label">{{ trans('geolocation.lat') }}</label>
    {{ html()->text('warehouse_lat')->class('form-control decimal') }}
</div>

{{-- Longitud --}}
<div class="form-group col-12 col-lg-2">
    <label class="control-label">{{ trans('geolocation.lng') }}</label>
    {{ html()->text('warehouse_lng')->class('form-control decimal') }}
</div>
