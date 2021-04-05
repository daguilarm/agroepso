/**
 *
 * ////////////////////////////
 * ////// * Forms Functions * //////
 * ////////////////////////////
 *
 */

    export default {
        form_comboBox: form_comboBox,
        form_select_create: form_select_create,
        text_area: text_area,
    };

    /**
    * Creating a select combo box
    */
    function form_comboBox( container, selected, routePath, required = true ) {
        //Add loading class
        container.empty().addClass( 'loading' );
        //Get the data via AJAX
        $.get( window.location.origin + routePath, { search: selected },
        function( data ) {
            //Generate the form select
            form_select_create( data, container, required );
        });
    }

    /**
    * Creating a new form
    */
    function form_select_create( data, container, required = true ) {
        if( data.length > 0 ) {
            //First empty option field
            container.append( $( '<option>', { value: '', text : '' } ) );
            //Built the select
            $.each( data, function( index, element ) {
                container.append( $( '<option>', {
                    value: element.id,
                    text : element.name
                }));
            });
            //Remove loading class, and enable the container
            container
                .prop( 'required', required )
                .removeClass( 'loading' );
        } else {
            //Remove loading class, and disable the container
            container
                .prop( 'required', false )
                .removeClass( 'loading' );
        }
    }

    /**
    * Count the characters of a textarea and print the output
    */
    function text_area() {
         //Get the containers
         var textarea = $( this );
         var message = $( '#textareaAlert-' + textarea.attr( 'id' ) );
         //Max length for textarea
         var maxlength = textarea.attr( 'maxlength' );
         //Get the limit from maxlength attribute
         var limit = parseInt( maxlength );
         //get the current text inside the textarea
         var text = textarea.val();
         //Output the text
         return ( text.length > 0 )
            ? message.html( 'Ha escrito <b>' + text.length + '</b> caracteres de los ' + maxlength + ' permitidos' )
            : message.html('');
    }
