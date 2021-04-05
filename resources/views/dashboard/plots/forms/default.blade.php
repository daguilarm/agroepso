<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label')) !!}

    {{-- Clients --}}
    {!! Form::selectClients($data ?? null, $withCrops = true, 'plot') !!}

    {{-- Users --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label col-12">{{ trans_title('users') }}</label>
        {!! Form::selectUsers($data ?? null) !!}
    </div>

    {{-- Select plant --}}
    @if(getClient('module.plants'))
        <div class="form-group col-12 col-lg-3">
            <label class="control-label">{{ trans_title('plants') }}</label>
            {!! Form::selectPlants($data ?? null) !!}
        </div>
    @endif

    {{-- Select warehouse --}}
    @if(getClient('module.warehouses'))
        <div class="form-group col-12 col-lg-3">
            <label class="control-label">{{ trans_title('warehouses') }}</label>
            {!! Form::selectWarehouses($data ?? null) !!}
        </div>
    @endif

    <div class="col-12"><hr></div>

    {{-- Plot ref --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">@lang('system.code')</label>
        {!! Form::autoIncrement('plot', $data) !!}
        <small id="helpBlock" class="form-text text-muted">@lang('system.code-text')</small>
    </div>

    {{-- Plot active --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">@lang('persona.contact.active')</label>
        {{ html()->select('plot_active')->options(selectBoolean())->value(optional($data)->plot_active ?? 'yes')->class('form-control')->required() }}
    </div>

    {{-- Plot name --}}
    <div class="form-group col-12 col-lg-8">
        <label class="control-label">@lang('persona.contact.name')</label>
        {{ html()->text('plot_name')->class('form-control') }}
        <small id="helpBlock" class="form-text text-muted">{{ sections('plots.auto') }}</small>
    </div>

    {{-- Plot area --}}
    <div class="col-12 col-lg-2">
        <label class="control-label">{{ sections('plots.area') }}</label>
        <div class="input-group">
            {{ html()->text('plot_area')->class('form-control number') }}
            <div class="input-group-append">
                <div class="input-group-text">ha</div>
            </div>
            <small id="helpBlock" class="form-text text-muted">{{ sections('plots.forms.sigpac') }}</small>
        </div>
    </div>

    {{-- Plot % area --}}
    <div class="col-12 col-lg-2">
        <label class="control-label">{{ sections('plots.cultivated_land') }}</label>
        <div class="input-group">
            {{ html()->text('plot_percent_cultivated_land')->value( optional($data)->plot_percent_cultivated_land ?? 100 )->class('form-control number') }}
            <div class="input-group-append">
                <div class="input-group-text">%</div>
            </div>
        </div>
    </div>

    {{-- Plot real area --}}
    <div class="col-12 col-lg-2">
        <label class="control-label">{{ sections('plots.real_area') }}</label>
        <div class="input-group">
            {{ html()->text('plot_real_area')->class('form-control number')->readonly() }}
            <div class="input-group-append">
                <div class="input-group-text">ha</div>
            </div>
            <small id="helpBlock" class="form-text text-muted">{{ trans('system.auto') }}</small>
        </div>
    </div>


    {{-- Plot framework --}}
    @if(getClient('option.plot-framework'))
        {{-- Plot framework x--}}
        <div class="col-12 col-lg-2">
            <label class="control-label">{{ sections('plots.framework_x') }}</label>
            <div class="input-group">
                {{ html()->text('plot_framework_x')->class('form-control number') }}
                <div class="input-group-append">
                    <div class="input-group-text">m</div>
                </div>
                <small id="helpBlock" class="form-text text-muted">{{ sections('plots.forms.framework') }}</small>
            </div>
        </div>

        {{-- Plot framework y--}}
        <div class="col-12 col-lg-2">
            <label class="control-label">{{ sections('plots.framework_y') }}</label>
            <div class="input-group">
                {{ html()->text('plot_framework_y')->class('form-control number') }}
                <div class="input-group-append">
                    <div class="input-group-text">m</div>
                </div>
                <small id="helpBlock" class="form-text text-muted">{{ sections('plots.forms.framework') }}</small>
            </div>
        </div>
    @endif

    {{-- Plot quantity--}}
    @if(getClient('option.plot-quantity'))
        <div class="col-12 col-lg-2">
            <label class="control-label">{{ sections('plots.quantity') }}</label>
            <div class="input-group">
                {{ html()->text('plot_crop_quantity')->attribute('data-decimal', 0)->class('form-control number') }}
                <div class="input-group-append">
                    <div class="input-group-text">uds</div>
                </div>
                <small id="helpBlock" class="form-text text-muted">{{ trans('system.auto:maybe') }}</small>
            </div>
        </div>
    @endif
</div>

<div class="col-12"><hr></div>

{{-- Include optionals fields --}}
@include(dashboard_path($section. '.forms.optional'))
