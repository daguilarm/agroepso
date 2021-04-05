<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label')) !!}

    @include(dashboard_path($section . '.forms._configuration'))

    <div class="col-12"><hr></div>

    {{-- Plant name --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans_title('plants') }}</label>
        {{ html()->text('plant_name')->attribute('maxlength', 150)->class('form-control')->required() }}
    </div>

    {{-- Plant company --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans('system.company') }}</label>
        {{ html()->text('plant_company')->attribute('maxlength', 150)->class('form-control')->required() }}
    </div>

    {{-- Plant nif --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.id.all') }}</label>
        {{ html()->text('plant_nif')->attribute('maxlength', 50)->class('form-control')->required() }}
    </div>

    {{-- Plant telephone --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.telephone') }}</label>
        {{ html()->text('plant_telephone')->attribute('maxlength', 20)->class('form-control') }}
    </div>

    {{-- Plant address --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans('persona.contact.address') }}</label>
        {{ html()->text('plant_address')->attribute('maxlength', 150)->class('form-control') }}
    </div>

    {{-- Plant state --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.state') }}</label>
        {{ html()->text('plant_state')->attribute('maxlength', 100)->class('form-control') }}
    </div>

    {{-- Plant region --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.region') }}</label>
        {{ html()->text('plant_region')->attribute('maxlength', 100)->class('form-control') }}
    </div>

    {{-- Plant city --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.city') }}</label>
        {{ html()->text('plant_city')->attribute('maxlength', 100)->class('form-control') }}
    </div>

    {{-- Plant zip --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.zip') }}</label>
        {{ html()->text('plant_zip')->attribute('maxlength', 10)->class('form-control') }}
    </div>

    {{-- Plant contact --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans('persona.contact.contact') }}</label>
        {{ html()->text('plant_contact')->attribute('maxlength', 150)->class('form-control') }}
    </div>

    {{-- Plant email --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans('persona.contact.email') }}</label>
        {{ html()->email('plant_email')->attribute('maxlength', 150)->class('form-control') }}
    </div>
</div>
