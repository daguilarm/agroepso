<div class="row">
    {!! Form::formTitle('graph', sections($section . '.forms.label-management')) !!}

    {{-- User reference --}}
    @role('admin')
        {{-- Code from AJAX when select client --}}
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ trans('system.code') }}</label>
            {!! Form::autoIncrement('user', $data ?? null) !!}
            <small id="helpBlock" class="form-text text-muted">@lang('system.code-text')</small>
        </div>
    @else
        {{-- Code --}}
        <div class="form-group col-12 col-lg-2">
            <label class="control-label">{{ trans('system.code') }}</label>
            {!! Form::autoIncrement('user', $data ?? null) !!}
            <small id="helpBlock" class="form-text text-muted">@lang('system.code-text')</small>
        </div>
    @endrole

    {{-- CIF --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">@lang('persona.id.all')</label>
        {{ html()->text('nif')->attribute('maxlength', 50)->class('form-control text-right') }}
    </div>
</div>
