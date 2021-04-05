{{-- City info --}}
@include(dashboard_path('z_admin.' . $section . '.forms.default'))

<hr>

{{-- Country, state and regions --}}
@include(dashboard_path('z_admin.' . $section . '.forms.relationships'))

{{-- Form footer --}}
{!! Form::footerButtons($data ?? null) !!}