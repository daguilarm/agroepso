<div class="row">
    {!! Form::formTitle('image', sections($section . '.forms.label-image')) !!}

    {{-- Load logo if exists --}}
    @isset($data)
        <img src="{{ route('dashboard.image', ['Client', $data->id]) }}">
    @endif

    {{-- Logo --}}
    <div class="form-group col-12 col-lg-4 col-xl-3">
        <label class="control-label">@lang('persona.contact.logotype')</label>
        {{ html()->file('_image')->class('form-control') }}
    </div>
</div>
