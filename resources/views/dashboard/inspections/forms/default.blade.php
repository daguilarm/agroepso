<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label')) !!}

    {{-- Client --}}
    {{ html()->hidden('client_id')->value(Credentials::client()) }}

    {{-- Crop --}}
    {{ html()->hidden('crop_id')->value(Credentials::crop()) }}

    {{-- User --}}
    {{ html()->hidden('user_id')->value(Credentials::id()) }}

    {{-- Inspector Name --}}
    <div class="form-group col-12 col-md-4">
        <label class="control-label">{{ sections('inspections.surveyor') }}</label>
        {{ html()->text('user_name')->class('form-control')->value(Credentials::name())->disabled() }}
    </div>

    {{-- User/Associate --}}
    <div class="form-group col-12 col-md-2">
        <label class="control-label">{{ trans_title('users') }}</label>
        {{ html()->select('inspector_id')->class('form-control')->options($users)->required() }}
    </div>

    {{-- Date --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('inspections.date') }}</label>
        {{ html()->text('agronomic_date')->class('form-control date') }}
    </div>

    {{-- Date planing --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('inspections.date_planing') }}</label>
        {{ html()->text('agronomic_date')->class('form-control date') }}
    </div>

    {{-- Status --}}
    <div class="form-group col-12 col-md-2">
        <label class="control-label">{{ sections('inspections.status') }}</label>
        {{ html()->select('inspection_status')->class('form-control')->options(selectInspectionStatus())->required() }}
    </div>

    {{-- Type --}}
    <div class="form-group col-12 col-md-2">
        <label class="control-label">{{ sections('inspections.type') }}</label>
        {{ html()->select('inspection_type')->class('form-control')->options(selectInspectionType())->required() }}
    </div>

    {{-- Inspection Document --}}
    <div class="form-group col-12 col-md-2">
        <label class="control-label">{{ sections('inspections.document') }}</label>
        {{ html()->select('inspection_document')->class('form-control')->options($files)->required() }}
    </div>
</div>

<hr>

<div id="custom_document" data-key="{{ Credentials::cropKey() }}"></div>

<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.result')) !!}

    {{-- Result --}}
    <div class="form-group col-12 col-md-2">
        <label class="control-label">{{ sections('inspections.result') }}</label>
        {{ html()->select('inspection_result')->class('form-control')->options(selectInspectionResult())->required() }}
    </div>

    {{-- Observations --}}
    <div class="form-group col-12">
        <label class="control-label">{{ trans('system.observations') }}</label>
        {!! Form::autoTextArea('inspection_observations', $required = false) !!}
    </div>
</div>

@section('javascript')
    <script>
        $( function() {
            $( '#inspection_document' ).on( 'change', function() {
                var container = $( '#custom_document' );
                container.load( 'ajax/document/' + container.data( 'key' ) + '/' + $( this ).val() );
            });
        });
    </script>
@endsection
