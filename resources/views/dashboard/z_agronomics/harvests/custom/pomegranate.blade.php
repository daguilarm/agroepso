<hr>
<div class="row">
    {{-- pH --}}
    <div class="form-group col-12 col-lg-1 col-md-2">
        <label class="control-label">{{ trans('parametters.ph') }}</label>
        {{ html()->text('custom_parameters[ph]')->class('form-control number')->disabled($readonly) }}
    </div>

    {{-- °Bx --}}
    <div class="form-group col-12 col-lg-1 col-md-2">
        <label class="control-label">{{ trans('parametters.bx') }}</label>
        {{ html()->text('custom_parameters[bx]')->class('form-control number')->disabled($readonly) }}
    </div>
</div>
