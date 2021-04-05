<div class="row">
    {!! Form::formTitle($section, sections($section . '.forms.label')) !!}

    {{-- User --}}
    {{ html()->hidden('user_id')->value(Credentials::id()) }}

    {{-- Client --}}
    {{ html()->hidden('client_id')->value(Credentials::client()) }}

    {{-- Crop --}}
    {{ html()->hidden('crop_id')->value(Credentials::crop()) }}

    {{-- Plots --}}
    <div class="form-group col-12 col-lg-6 col-xl-2">
        <label class="control-label">{{ trans_title('plots') }}</label>
        @if(!empty($readonly))
            {{ html()->select('plot_id')->class('form-control')->options($plots ?? [])->attribute('disabled') }}
        @else
            {{ html()->select('plot_id')->class('form-control')->options($plots ?? [])->required() }}
        @endif
    </div>
</div>

<hr>

<div class="row">
    {{-- Date --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ sections('harvests.date') }}</label>
        {{ html()->text('agronomic_date')->class('form-control date')->disabled($readonly) }}
    </div>

    {{-- Quantity --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">{{ trans('system.quantity') }}</label>
        {{ html()->text('agronomic_quantity')->class('form-control number')->disabled($readonly) }}
    </div>

    {{-- Units --}}
    <div class="form-group col-12 col-lg-1 col-md-2">
        <label class="control-label">{{ trans('system.units') }}</label>
        @if(!empty($readonly))
            {{ html()->select('agronomic_quantity_unit')->class('form-control')->options(selectUnits())->attribute('disabled') }}
        @else
            {{ html()->select('agronomic_quantity_unit')->class('form-control')->options(selectUnits())->required() }}
        @endif
    </div>

    {{-- Observations --}}
    <div class="form-group col-12">
        <label class="control-label">{{ trans('system.observations') }}</label>
        {!! Form::autoTextArea('agronomic_observations', $required = false, $maxLength = 250, $rows = 5, $disabled = $readonly) !!}
    </div>
</div>

{{-- Include custom (for crop) values --}}
@includeIf('dashboard.z_agronomics.harvests.custom.' . Credentials::cropKey())
