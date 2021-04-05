<div id="modal-client" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-client-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title text-light" id="modal-client-title">{!! icon('error', trans('alerts.client.confirm')) !!}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-client-body">
                @foreach(trans('alerts.client.msg') as $message)
                    <p class="alert alert-warning">{!! icon('form') !!} <span class="ml-2">{{ $message }}</span></p>
                @endforeach
                <div class="row">
                    <div class="form-group col-6">
                        <label class="control-label">{{ trans_title('clients') }}</label>
                        {{ html()->text('client_name_auto')->class('form-control') }}
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-danger" data-dismiss="modal">{!! icon('cancel', trans('buttons.cancel')) !!}</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom jquery for modal --}}
<script>
    $(function () {
        "use strict";
        /**
         * Change admin client
         */
        $( '#client_name_auto' ).autoComplete({
            minChars: 3,
            source: function( query, response ) {
                //Reset the fields
                //Get ajax response with cache
                try { xhr.abort(); } catch( e ){}
                xhr = $.getJSON( window.location.origin + '/dashboard/ajax/clients', { search: $( '#client_name_auto' ).val() }, function( data ) {
                    response( data );
                });
            },
            renderItem: function ( item, search ){
                return '<div class="autocomplete-suggestion" data-id="' + item[ 'id' ] + '" data-name="' + item[ 'client_name' ] + '">'
                            + item[ 'client_name' ] +
                        '</div>';
            },
            onSelect: function( e, term, item ) {
                location.href = window.location.origin + '/dashboard/tools/clients/' + item.data( 'id' );
            }
        });
    });
</script>
