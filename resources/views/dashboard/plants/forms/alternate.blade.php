<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label-alternate')) !!}

    {{-- Plant nif --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.id.all') }}</label>
        {{ html()->text('plant_nif_alt')->attribute('maxlength', 50)->class('form-control') }}
    </div>

    {{-- Plant telephone --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.telephone') }}</label>
        {{ html()->text('plant_telephone_alt')->attribute('maxlength', 20)->class('form-control') }}
    </div>

    {{-- Plant address --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans('persona.contact.address') }}</label>
        {{ html()->text('plant_address_alt')->attribute('maxlength', 150)->class('form-control') }}
    </div>

    {{-- Plant state --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.state') }}</label>
        {{ html()->text('plant_state_alt')->attribute('maxlength', 100)->class('form-control') }}
    </div>

    {{-- Plant region --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.region') }}</label>
        {{ html()->text('plant_region_alt')->attribute('maxlength', 100)->class('form-control') }}
    </div>

    {{-- Plant city --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.city') }}</label>
        {{ html()->text('plant_city_alt')->attribute('maxlength', 100)->class('form-control') }}
    </div>

    {{-- Plant zip --}}
    <div class="form-group col-12 col-lg-3">
        <label class="control-label">{{ trans('persona.contact.zip') }}</label>
        {{ html()->text('plant_zip_alt')->attribute('maxlength', 10)->class('form-control') }}
    </div>

    {{-- Plant contact --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans('persona.contact.contact') }}</label>
        {{ html()->text('plant_contact_alt')->attribute('maxlength', 150)->class('form-control') }}
    </div>

    {{-- Plant email --}}
    <div class="form-group col-12 col-lg-6">
        <label class="control-label">{{ trans('persona.contact.email') }}</label>
        {{ html()->email('plant_email_alt')->attribute('maxlength', 150)->class('form-control') }}
    </div>
</div>
