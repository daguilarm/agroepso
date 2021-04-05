<div class="row">
    {!! Form::formTitle(null, 'Acta de inspección de las instalaciones de acondicionamiento y envasado') !!}

    {{-- Inspector Name --}}
    <div class="form-group col-12 col-md-2">
        <label class="control-label">Acta Nº</label>
        {{ html()->text('user_name')->class('form-control') }}
    </div>

    {{-- Plot active --}}
    <div class="form-group col-12 col-lg-2">
        <label class="control-label">Documentación</label>
        {{ html()->select('plot_active')->options(selectBoolean())->class('form-control')->required() }}
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="well">
            <ul class="list-group checked-list-box">
                <li class="list-group-item">
                    Documentación que identifique la personalidad jurídica
                </li>
                <li class="list-group-item">
                    Registro sanitario
                </li>
                <li class="list-group-item">
                    Última inspección de sanidad
                </li>
            </ul>
        </div>
    </div>
</div>

