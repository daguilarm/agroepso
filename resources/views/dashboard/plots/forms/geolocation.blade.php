<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label-geolocation')) !!}

    {{-- Plot region --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ trans('persona.contact.region') }}</label>
        {{ html()->text('region.region_name')->class('form-control')->disabled() }}
    </div>

    {{-- Plot city --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ trans('persona.contact.city') }}</label>
        {{ html()->text('city.city_name')->class('form-control')->disabled() }}
    </div>

    {{-- Plot sigpac region --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('plots.sigpac.region') }}</label>
        {{ html()->text('geolocation.geo_sigpac_region')->id('geolocation_sigpac_region')->class('form-control text-right')->required() }}
    </div>

    {{-- Plot sigpac city --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('plots.sigpac.city') }}</label>
        {{ html()->text('geolocation.geo_sigpac_city')->id('geolocation_sigpac_city')->class('form-control text-right')->required() }}
    </div>

    {{-- Plot sigpac polygon --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('plots.sigpac.polygon') }}</label>
        {{ html()->text('geolocation.geo_sigpac_polygon')->id('geolocation_sigpac_polygon')->class('form-control text-right')->required() }}
    </div>

    {{-- Plot sigpac plot --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('plots.sigpac.plot') }}</label>
        {{ html()->text('geolocation.geo_sigpac_plot')->id('geolocation_sigpac_plot')->class('form-control text-right')->required() }}
    </div>

    {{-- Message about Sigpac --}}
    <div class="alert alert-warning">
        @foreach(sections('plots.sigpac.alert') as $value)
            <li>{{ $value }}.</li>
        @endforeach
    </div>
</div>

<div class="col-12"><hr></div>

<div class="row">
    {!! Form::formTitle($section, trans('system.optional:data')) !!}

    {{-- Plot sigpac precint --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('plots.sigpac.precinct') }}</label>
        {{ html()->text('geolocation.geo_sigpac_precinct')->class('form-control text-right') }}
    </div>

    {{-- Plot sigpac aggregate --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('plots.sigpac.aggregate') }}</label>
        {{ html()->text('geolocation.geo_sigpac_aggregate')->class('form-control text-right') }}
        <small id="helpBlock" class="form-text text-muted">{{ sections('plots.sigpac.optional') }}</small>
    </div>

    {{-- Plot sigpac zone --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('plots.sigpac.zone') }}</label>
        {{ html()->text('geolocation.geo_sigpac_zone')->class('form-control text-right') }}
        <small id="helpBlock" class="form-text text-muted">{{ sections('plots.sigpac.optional') }}</small>
    </div>

    {{-- Plot catastro --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ trans('geolocation.catastro') }}</label>
        {{ html()->text('geolocation.geo_catastro')->class('form-control text-right') }}
        <small id="helpBlock" class="form-text text-muted">{{ sections('plots.sigpac.optional') }}</small>
    </div>

    {{-- Plot height --}}
    <div class="col-12 col-lg-2 mt-2">
        <label class="control-label">{{ trans('geolocation.height') }}</label>
        <div class="input-group">
            {{ html()->text('geolocation.geo_height')->class('form-control number')->disabled() }}
            <div class="input-group-append">
                <div class="input-group-text">m</div>
            </div>
        </div>
        <small id="helpBlock" class="form-text text-muted">{{ sections('plots.sigpac.optional') }}</small>
    </div>
</div>

<div class="col-12"><hr></div>

<div class="row">
    {{-- Plot lat --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ trans('geolocation.lat') }}</label>
        {{ html()->text('geolocation.geo_lat')->class('form-control decimal') }}
        <small id="helpBlock" class="form-text text-muted">{{ sections('plots.sigpac.optional') }}</small>
    </div>

    {{-- Plot lng --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ trans('geolocation.lng') }}</label>
        {{ html()->text('geolocation.geo_lng')->class('form-control decimal') }}
        <small id="helpBlock" class="form-text text-muted">{{ sections('plots.sigpac.optional') }}</small>
    </div>

    {{-- Plot UTM x --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ trans('geolocation.x') }}</label>
        {{ html()->text('geolocation.geo_x')->class('form-control number') }}
        <small id="helpBlock" class="form-text text-muted">{{ sections('plots.sigpac.optional') }}</small>
    </div>

    {{-- Plot UTM y --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ trans('geolocation.y') }}</label>
        {{ html()->text('geolocation.geo_y')->class('form-control number') }}
        <small id="helpBlock" class="form-text text-muted">{{ sections('plots.sigpac.optional') }}</small>
    </div>

    {{-- Plot UTM zone --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ trans('geolocation.zone') }}</label>
        {{ html()->text('geolocation.zone')->type('number')->attribute('min', 27)->attribute('max', 31)->attribute('step', 1)->class('form-control text-right') }}
        <small id="helpBlock" class="form-text text-muted">{{ sections('plots.sigpac.optional') }}</small>
    </div>
</div>
