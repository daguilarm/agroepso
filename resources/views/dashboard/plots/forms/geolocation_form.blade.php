<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label')) !!}

    {{-- Clients --}}
    {!! Form::selectClients($data ?? null, $withCrops = true, 'plot') !!}

    {{ html()->hidden('crop_id')->value(1) }}

    {{-- Users --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label col-12">{{ trans_title('users') }}</label>
        {!! Form::selectUsers($data ?? null) !!}
    </div>

    {{-- Plot ref --}}
    <div class="form-group col-6 col-lg-2">
        <label class="control-label">@lang('system.code')</label>
        {!! Form::autoIncrement('plot', $data ?? null) !!}
        <small id="helpBlock" class="form-text text-muted">@lang('system.code-text')</small>
    </div>

    {{-- Plot active --}}
    <div class="form-group col-6 col-lg-2">
        <label class="control-label">@lang('persona.contact.active')</label>
        {{ html()->select('plot_active')->options(selectBoolean())->value(optional($data ?? null)->plot_active ?? 'yes')->class('form-control')->required() }}
    </div>

    <div class="form-group col-6 col-lg-2">
        <label class="control-label">Separación de lineas</label>
        {{ html()->text('plot_framework_x')->class('form-control') }}
    </div>

    <div class="form-group col-6 col-lg-2">
        <label class="control-label">Distacia entre cepas</label>
        {{ html()->text('plot_framework_y')->class('form-control') }}
    </div>

    {{-- Plot name --}}
    <div class="form-group col-12 col-lg-8">
        <label class="control-label">@lang('persona.contact.name')</label>
        {{ html()->text('plot_name')->class('form-control') }}
        <small id="helpBlock" class="form-text text-muted">{{ sections('plots.auto') }}</small>
    </div>
</div>

<div class="col-12"><hr></div>

<div class="row">
    <div class="form-group col-3 col-lg-3">
        <label class="control-label">SIGPAC Región</label>
        {{ html()->text('geolocation.geo_sigpac_region')->class('form-control')->value($data['region']) }}
    </div>
    <div class="form-group col-3 col-lg-3">
        <label class="control-label">SIGPAC Municipio</label>
        {{ html()->text('geolocation.geo_sigpac_city')->class('form-control')->value($data['city']) }}
    </div>
    <div class="form-group col-3 col-lg-3">
        <label class="control-label">SIGPAC Polígono</label>
        {{ html()->text('geolocation.geo_sigpac_polygon')->class('form-control')->value($data['polygon']) }}
    </div>
    <div class="form-group col-3 col-lg-3">
        <label class="control-label">SIGPAC Parcela</label>
        {{ html()->text('geolocation.geo_sigpac_plot')->class('form-control')->value($data['plot']) }}
    </div>
</div>

{{-- Form footer --}}
{!! Form::footerButtons() !!}
