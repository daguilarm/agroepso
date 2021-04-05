<div class="row">
    {{-- Quality IGP --}}
    @if(getClient('option.plot-igp'))
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ trans('quality.igp.under') }}</label>
            {{ html()->select('plot_quality_igp')->options(selectBoolean())->value( optional($data)->plot_quality_igp ?? 'yes' )->class('form-control') }}
        </div>
    @endif

    {{-- Quality DOP --}}
    @if(getClient('option.plot-dop'))
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ trans('quality.dop.under') }}</label>
            {{ html()->select('plot_quality_dop')->options(selectBoolean())->value( optional($data)->plot_quality_dop ?? 'yes' )->class('form-control') }}
        </div>
    @endif
</div>
