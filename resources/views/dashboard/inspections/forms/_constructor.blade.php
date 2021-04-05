{{-- Default data --}}
@include(dashboard_path($section . '.forms.default'))

{{-- Form footer --}}
{!! Form::footerButtons($data ?? null) !!}
