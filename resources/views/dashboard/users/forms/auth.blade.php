<div class="row">
    {!! Form::formTitle('password', sections($section . '.forms.label-access')) !!}

    {{-- Email --}}
    <div class="form-group col-12 col-lg-6 col-xl-5">
        <label class="control-label">@lang('persona.contact.email')</label>
        {{ html()->email('email')->attribute('maxlength', 150)->class('form-control')->required() }}
    </div>

    {{-- Password --}}
    <div class="form-group col-12 col-lg-6 col-xl-2">
        <label class="control-label">@lang('auth.password')</label>
        {{ html()->password('password')->class('form-control')->value(false)->required(isset($data) ? false : true) }}
    </div>

    {{-- Re-Password --}}
    <div class="form-group col-12 col-lg-6 col-xl-2">
        <label class="control-label">@lang('auth.password_confirm')</label>
        {{ html()->password('password_confirmation')->value(false)->class('form-control')->required(isset($data) ? false : true) }}
    </div>

    {{-- Active user --}}
    <div class="form-group col-12 col-lg-6 col-xl-2">
        <label class="control-label">@lang('persona.contact.active')</label>
        {{ html()->select('active')->options(configuration('boolean', $emptyField = true))->value(!isset($data) ? 1 : $data->active)->class('form-control')->required() }}
    </div>
</div>
