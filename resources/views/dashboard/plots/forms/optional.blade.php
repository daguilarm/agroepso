<div class="row">
    {{-- Plot pond --}}
    @if(getClient('option.plot-pond'))
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ sections('plots.pond') }}</label>
            {{ html()->select('plot_pond')->options(selectBoolean())->class('form-control') }}
        </div>
    @endif

    {{-- Plot road --}}
    @if(getClient('option.plot-road'))
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ sections('plots.road') }}</label>
            {{ html()->select('plot_road')->options(selectRoad())->class('form-control') }}
        </div>
    @endif
</div>
