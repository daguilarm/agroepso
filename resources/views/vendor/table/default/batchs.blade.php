@if (!empty($batchActions))
    @section('javascript')
        <script type="text/javascript">
            function toggleSelectAll() {
                var selectAllCheckbox = window.event.target;
                if (selectAllCheckbox.type != 'checkbox') {
                    selectAllCheckbox = selectAllCheckbox.querySelector('input[type=checkbox]');
                }
                var inputs = document.querySelectorAll(".table-content tbody input[type=checkbox]");
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].checked = selectAllCheckbox.checked;
                    if (inputs[i].onchange) {
                        inputs[i].onchange();
                    }
                }
            }
            function toggleInnerCheckbox() {
                var target = window.event.target;
                var checkbox = target.querySelector('input[type=checkbox]');
                if (checkbox) {
                    checkbox.checked = !checkbox.checked;
                    if (checkbox.onchange) {
                        checkbox.onchange();
                    }
                }
            }
            function onFormSubmit() {
                var target = window.event.target;
                var inputs = document.querySelectorAll(".table-content tbody input[type=checkbox]");
                for (var i = 0; i < inputs.length; i++) {
                    if (inputs[i].checked) {
                        var checkbox = inputs[i].cloneNode(true)
                        checkbox.type = 'hidden';
                        target.appendChild(checkbox);
                    }
                }
            }
        </script>
    @endsection
@endif
