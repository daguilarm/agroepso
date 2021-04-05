@extends('dashboard._layouts._app')

@section('content')
    <main class="app-content">
        {{-- Head title --}}
        @component(component_path('head'))
            {{-- Breadcrumb items [title, link] --}}
            @slot('breadcrumbItems', [
                ['title' => 'Crear un seed desde la base de datos']
            ])
        @endcomponent

        {{ html()
            ->form('POST')
            ->id('form-create-seed')
            ->open()
        }}
            <div class="col-md-12" id="form-container">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row">
                            {{-- Tables --}}
                            <div class="form-group col-3">
                                <label>Nombre de la tabla</label>
                                <select name="tableName" id="tableName" class="form-control">
                                    <option></option>
                                    @foreach($tables as $table)
                                        <option name="{{ $table->$db }}">{{$table->$db }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Row fields --}}
                            <div class="form-group col-12">
                                <label>Nombre de las columnas</label>
                                <div id="rowColumns" class="form-group col-12"></div>
                            </div>

                            {{-- Sql filter --}}
                            <div class="form-group col-12">
                                <label>Filtro SQL</label>
                                {{ html()->text('sqlFilter')->class('form-control')->placeholder('WHERE plots.client_id = 5 AND plots.deleted_at IS NULL') }}
                            </div>

                            {{-- File name --}}
                            <div class="form-group col-4">
                                <label>Nombre del archivo</label>
                                {{ html()->text('fileName')->class('form-control') }}
                            </div>
                        </div>
                    </div>
                    {{-- Form footer --}}
                    {!! Form::footerButtons(null) !!}
                </div>
            </div>

        {{ html()->form()->close() }}
    </main>
@endsection

@section('javascript')
    <script>
        $( function() {
            $( '#tableName' ).on( 'change', function() {
                var tableName = $( this ).val();
                //Get the totals
                $.get( window.location.origin + '/dashboard/ajax/seeds', { table: tableName },
                function( data ) {
                    $.each( data, function( key, value ) {
                        var checkbox =
                            '<div class="float-left input-group col-3">' +
                                '<input type="checkbox" name="rowName[]" value="' + value  + '" class="form-check-input" checked>' +
                                '<div class="ml-2 mt-3">' + value + '</div>' +
                            '</div>';
                        $( '#rowColumns' ).append( checkbox );
                    });
                });
                //Add file name
                $('#fileName').val( window.studly_case( tableName ) + 'TableSeeder' );
            });
        });
    </script>
@endsection
