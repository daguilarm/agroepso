<div class="row">
    {!! Form::formTitle('world', sections($section . '.forms.label-relationships')) !!}

    {{-- Countries --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">@lang('persona.contact.country')</label>
        {{ html()->select('country_id')->class('form-control')->options($countries)->required() }}
    </div>

    {{-- States --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">@lang('persona.contact.state')</label>
        {{ html()->select('state_id')->class('form-control')->options($states)->required() }}
    </div>

    {{-- Regions --}}
    @if(isset($data))
        <div class="form-group col-12 col-lg-3">
            <label class="control-label">@lang('persona.contact.region')</label>
            {{ html()->select('region_id')->class('form-control')->options($regions)->required() }}
        </div>
    @else 
        <div class="form-group col-12 col-lg-3">
            <label class="control-label">@lang('persona.contact.region')</label>
            {{ html()->select('region_id')->class('form-control')->options([])->attribute('disable', true) }}
        </div>
    @endif
</div>