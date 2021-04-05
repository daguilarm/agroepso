{{-- User personal data --}}
@include(dashboard_path($section . '.forms.personal'))

<hr>

{{-- User auth data --}}
@include(dashboard_path($section . '.forms.auth'))

<hr>

{{-- User production data --}}
@include(dashboard_path($section . '.forms.management'))

{{-- Form footer --}}
{!! Form::footerButtons($data ?? null) !!}