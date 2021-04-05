<div class="row">
    {!! Form::formTitle('user', sections($section . '.forms.label')) !!}

    {{-- Name --}}
    <div class="form-group col-12 col-lg-6 col-xl-5">
        <label class="control-label">@lang('persona.contact.name')</label>
        {{ html()->text('name')->attribute('maxlength', 150)->class('form-control')->required() }}
    </div>

    {{-- On behalf of --}}
    <div class="form-group col-12 col-lg-6 col-xl-5">
        <label class="control-label">@lang('persona.contact.deputy')</label>
        {{ html()->text('deputy_name')->attribute('maxlength', 150)->class('form-control') }}
    </div>

    {{-- Locale --}}
    <div class="form-group col-12 col-lg-6 col-xl-2">
        <label class="control-label">@lang('persona.contact.locale')</label>
        {{ html()->select('locale')->class('form-control')->options(configuration('locale'))->required() }}
    </div>

    {{-- Role --}}
    @hasanyrole('admin|dop')
        {!! Form::selectRoles($data ?? null) !!}
    @endhasanyrole

    {{-- Client --}}
    {{-- Only Admins can change the client --}}
    {!! Form::selectClients($data ?? null, $withCrops = false, 'user') !!}
</div>
