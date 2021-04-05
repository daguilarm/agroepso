{{ html()
    ->form('DELETE', route('dashboard'))
    ->id('form-delete')
    ->open()
}}
    <div id="modal-delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-delete-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-light" id="modal-delete-title">{!! icon('delete', trans('alerts.delete.confirm')) !!}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-delete-body">
                    @foreach(trans('alerts.delete.msg') as $message)
                        <p class="alert alert-warning">{!! icon('form') !!} <span class="ml-2">{{ $message }}</span></p>
                    @endforeach

                    <div class="text-center">
                        {{ html()->hidden('delete_message')->value(trans('alerts.delete.default')) }}
                        {{ html()->submit(icon('delete', trans('buttons.delete')))->class('btn btn-danger') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
{{ html()->form()->close() }}
