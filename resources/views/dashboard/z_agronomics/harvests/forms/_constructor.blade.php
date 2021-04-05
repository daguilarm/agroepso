{{-- Default data --}}
@include(dashboard_path('z_agronomics.' . $section . '.forms.default'))

{{-- Form footer --}}
@if($readonly)
    {!! Form::showButtons() !!}
@else
    {!! Form::footerButtons($data ?? null) !!}
@endif
