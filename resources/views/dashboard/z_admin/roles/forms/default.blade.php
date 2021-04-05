<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label')) !!}

    {{-- Email --}}
    <div class="form-group col-12">
        <label class="control-label">@lang('persona.contact.name')</label>
        {{ html()->text('name')->class('form-control')->required() }}
    </div>

    {{-- Permissions --}}
    <div class="form-group col-12">
        {!! Form::autoCheckBoxPermissions($allPermissions, $rolePermissions) !!}
    </div>
</div>