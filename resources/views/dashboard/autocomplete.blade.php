@section('javascript')
    {{-- <button id="autocomplete">autocomplete</button> --}}
    <script>
        $('<input>').attr({
            id: 'autocomplete',
            type: 'button',
            class: 'btn btn-info ml-3',
            value: 'autocomplete'
        }).insertAfter('.btn-success');

        $('#autocomplete').on('click', function() {
            $('#name').val('Damian Antonio Aguilar');
            $('#locale').find('option:eq(1)').prop('selected', true);
            $('#role').find('option:eq(1)').prop('selected', true);
            $('#client_id').find('option:eq(1)').prop('selected', true);
            $('#email').val('damian@damian.com');
            $('#password').val(123456);
        });
    </script>
    
@endsection