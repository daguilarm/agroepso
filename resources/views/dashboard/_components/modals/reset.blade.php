{{ html()
    ->form('POST', route('dashboard.' . $section . '.reset'))
    ->id('form-reset')
    ->open()
}}
    <div id="modal-reset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-reset-title" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-light" id="modal-reset-title">{!! icon('error', sections('plots.alert.confirm')) !!}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-delete-body">
                    @foreach(sections('plots.alert.messages') as $message)
                        <p class="alert alert-warning">{!! icon('form') !!} <span class="ml-2">{{ $message }}</span></p>
                    @endforeach

                    {{-- Clients --}}
                    {!! Form::selectClients($data ?? null, $withCrops = false, 'no-model') !!}

                    <div class="text-center">
                        {{ html()->hidden('delete_message')->value(trans('alerts.reset.success')) }}
                        {{ html()->submit(icon('reset', trans('buttons.reset')))->class('btn btn-danger') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
{{ html()->form()->close() }}
