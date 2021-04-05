<div class="row">
    {!! Form::formTitle('user', sections($section . '.forms.label-contact')) !!}

    {{-- Client Name --}}
    <div class="form-group col-12 col-lg-4">
        <label class="control-label">@lang('persona.contact.name')</label>
        {{ html()->text('client_name')->attribute('maxlength', 150)->class('form-control')->required() }}
    </div>
    {{-- Client Address --}}
    <div class="form-group col-12 col-lg-8">
        <label class="control-label">@lang('persona.contact.address')</label>
        {{ html()->text('client_address')->attribute('maxlength', 150)->class('form-control')->required() }}
    </div>
    {{-- Client contact --}}
    <div class="form-group col-12 col-lg-4">
        <label class="control-label">@lang('persona.contact.contact')</label>
        {{ html()->text('client_contact')->attribute('maxlength', 150)->class('form-control')->required() }}
    </div>
    {{-- Client email --}}
    <div class="form-group col-12 col-lg-4">
        <label class="control-label">@lang('persona.contact.email')</label>
        {{ html()->email('client_email')->attribute('maxlength', 150)->class('form-control')->required() }}
    </div>
    {{-- Client nif --}}
    <div class="form-group col-12 col-lg-4 col-xl-2">
        <label class="control-label">@lang('persona.id.nif')</label>
        {{ html()->text('client_nif')->attribute('maxlength', 50)->class('form-control')->required() }}
    </div>
    {{-- Client telephone --}}
    <div class="form-group col-12 col-lg-4 col-xl-2">
        <label class="control-label">@lang('persona.contact.telephone')</label>
        {{ html()->text('client_telephone')->attribute('maxlength', 20)->class('form-control')->required() }}
    </div>
    {{-- Client state --}}
    <div class="form-group col-12 col-lg-4 col-xl-3">
        <label class="control-label">@lang('persona.contact.state')</label>
        {{ html()->text('client_state')->attribute('maxlength', 100)->class('form-control') }}
    </div>
    {{-- Client region --}}
    <div class="form-group col-12 col-lg-4 col-xl-3">
        <label class="control-label">@lang('persona.contact.region')</label>
        {{ html()->text('client_region')->attribute('maxlength', 100)->class('form-control') }}
    </div>
    {{-- Client city --}}
    <div class="form-group col-12 col-lg-4 col-xl-3">
        <label class="control-label">@lang('persona.contact.city')</label>
        {{ html()->text('client_city')->attribute('maxlength', 100)->class('form-control') }}
    </div>
    {{-- Client zip --}}
    <div class="form-group col-12 col-lg-4 col-xl-3">
        <label class="control-label">@lang('persona.contact.zip')</label>
        {{ html()->text('client_zip')->attribute('maxlength', 10)->class('form-control') }}
    </div>
</div>
