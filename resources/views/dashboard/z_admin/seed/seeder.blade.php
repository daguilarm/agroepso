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
                            <textarea style="width:100%; height:500px">
                                {!! $seeder !!}
                            </textarea>
                        </div>
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
