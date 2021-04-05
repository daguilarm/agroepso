{!! Form::open(['url' => 'foo/bar', 'id' => 'form-delete']) !!}
    @component(component_path('modal'))
        @slot('bgColor', 'bg-danger')
        @slot('modalID', 'modal-delete')
        @slot('modalTitle', Icon::get('alert') . ' ' . __('Delete item'))
        @slot('modalBody', [
            __('If you delete the message, you can not retrieve it'),
            __('It is an irreversible procedure. Are you sure?'),
        ])
        @slot('modalButtons', '<button type="button" class="btn btn-default">button</button>')
    @endcomponent
    {{-- Add Item list --}}
    <input type="hidden" name="item-list" id="item-list">
{!! Form::close() !!}