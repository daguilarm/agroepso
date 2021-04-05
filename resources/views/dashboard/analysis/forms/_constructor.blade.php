{{-- Default data --}}
@include(dashboard_path($section . '.forms.default'))

{{-- Form footer --}}
{!! Form::footerButtons($data ?? null) !!}

{{--
    {{-- Custom fields. Sometimes we need to change somethig... --}}
    {{-- Item data --}}
    @isset($data)
        {{ html()->hidden('itemID', $data->id) }}
    @endisset

    {{-- Form buttons --}}
    @if(isset($data))
        {!! Form::editButtons() !!}
    @else
        {!! Form::createButtons() !!}
    @endif

    {{-- Mandatory advise --}}
    @lang('forms.mandatory')
--}}