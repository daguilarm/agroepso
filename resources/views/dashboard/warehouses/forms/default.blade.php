<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label')) !!}

    @include(dashboard_path($section . '.forms._configuration'))

    <div class="col-12"><hr></div>

    {{-- Warehouse name --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans_title('warehouses') }}</label>
        {{ html()->text('warehouse_name')->attribute('maxlength', 150)->class('form-control')->required() }}
    </div>

    {{-- Warehouse company --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans('system.company') }}</label>
        {{ html()->text('warehouse_company')->attribute('maxlength', 150)->class('form-control')->required() }}
    </div>

    {{-- Warehouse nif --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.id.all') }}</label>
        {{ html()->text('warehouse_nif')->attribute('maxlength', 50)->class('form-control') }}
    </div>

    {{-- Warehouse telephone --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.telephone') }}</label>
        {{ html()->text('warehouse_telephone')->attribute('maxlength', 20)->class('form-control') }}
    </div>

    {{-- Warehouse address --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans('persona.contact.address') }}</label>
        {{ html()->text('warehouse_address')->attribute('maxlength', 150)->class('form-control') }}
    </div>

    {{-- Warehouse state --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.state') }}</label>
        {{ html()->text('warehouse_state')->attribute('maxlength', 100)->class('form-control') }}
    </div>

    {{-- Warehouse region --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.region') }}</label>
        {{ html()->text('warehouse_region')->attribute('maxlength', 100)->class('form-control') }}
    </div>

    {{-- Warehouse city --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.city') }}</label>
        {{ html()->text('warehouse_city')->attribute('maxlength', 100)->class('form-control') }}
    </div>

    {{-- Warehouse zip --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.zip') }}</label>
        {{ html()->text('warehouse_zip')->attribute('maxlength', 10)->class('form-control') }}
    </div>

    {{-- Warehouse contact --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans('persona.contact.contact') }}</label>
        {{ html()->text('warehouse_contact')->attribute('maxlength', 150)->class('form-control') }}
    </div>
</div>
