<div class="row">
    {!! Form::formTitle('user', sections('profiles.forms.label')) !!}

    {{-- Name --}}
    <div class="form-group col-12 col-lg-4">
        <label class="control-label">@lang('persona.contact.name')</label>
        {{ html()->text('name')->attribute('maxlength', 150)->class('form-control')->required() }}
    </div>

    {{-- Email --}}
    <div class="form-group col-12 col-lg-4">
        <label class="control-label">@lang('persona.contact.email')</label>
        {{ html()->email('email')->attribute('maxlength', 150)->class('form-control')->disabled() }}
    </div>

    {{-- Birthdate --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">@lang('persona.contact.birthdate')</label>
        {{ html()->text('profile_birthdate')->class('form-control date')->value(optional($data->profile)->profile_birthdate) }}
    </div>

    {{-- Telephone --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">@lang('persona.contact.telephone')</label>
        {{ html()->text('profile_telephone')->attribute('maxlength', 30)->class('form-control')->value(optional($data->profile)->profile_telephone) }}
    </div>

    {{-- Address --}}
    <div class="form-group col-12">
        <label class="control-label">@lang('persona.contact.address')</label>
        {{ html()->textarea('profile_address')->attribute('maxlength', 150)->class('form-control')->attribute('rows', 5)->value(optional($data->profile)->profile_address) }}
    </div>

    {{-- Country --}}
    <div class="form-group col-6  col-lg-2">
        <label class="control-label">@lang('persona.contact.country')</label>
        {{ html()->text('profile_country')->attribute('maxlength', 100)->class('form-control')->value(optional($data->profile)->profile_country) }}
    </div>

    {{-- State --}}
    <div class="form-group col-6  col-lg-2">
        <label class="control-label">@lang('persona.contact.state')</label>
        {{ html()->text('profile_state')->attribute('maxlength', 100)->class('form-control')->value(optional($data->profile)->profile_state) }}
    </div>

    {{-- Region --}}
    <div class="form-group col-6  col-lg-2">
        <label class="control-label">@lang('persona.contact.region')</label>
        {{ html()->text('profile_region')->attribute('maxlength', 100)->class('form-control')->value(optional($data->profile)->profile_region) }}
    </div>

    {{-- City --}}
    <div class="form-group col-6  col-lg-4">
        <label class="control-label">@lang('persona.contact.city')</label>
        {{ html()->text('profile_city')->attribute('maxlength', 100)->class('form-control')->value(optional($data->profile)->profile_city) }}
    </div>

    {{-- Zip --}}
    <div class="form-group col-6  col-lg-2">
        <label class="control-label">@lang('persona.contact.zip')</label>
        {{ html()->text('profile_zip')->attribute('maxlength', 20)->class('form-control')->value(optional($data->profile)->profile_zip) }}
    </div>
</div>
