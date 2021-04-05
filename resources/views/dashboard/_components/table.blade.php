@if(!empty($operationLinks['submit']))
    {{ html()
        ->form('POST', $operationLinks['submit'])
        ->id('form-submit')
        ->open()
    }}
@endif

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    {{-- Start: List of buttons --}}
                    <div class="float-right">

                        {{-- Render all the links from App\Services\Tables --}}
                        {!! TableRender::buttons($operationLinks, $section, $headItems['description'] ?? null) !!}

                    </div>
                    {{-- End: List of buttons --}}

                    {{-- The table --}}
                    {!! $table->render() !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Add legend --}}
    @includeIf(dashboard_path($section . '.legend'))

@if(!empty($operationLinks['submit']))
    {{ html()->form()->close() }}
@endif
