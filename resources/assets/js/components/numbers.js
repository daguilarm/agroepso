/**
 *
 * ////////////////////////////
 * ////// * Number Functions * //////
 * ////////////////////////////
 *
 */
     export default {
         float_number: float_number,
         is_number: is_number,
         total_decimals: total_decimals,
     };

    var _max_decimals = 6;

    /**
     * Format number with 2 decimals and in english format: with a .
     */
    function float_number( number ) {
        return parseFloat( number.replace( ',', '.' ) )
            .toFixed( _max_decimals );
    }

    /**
     * Check if is a number
     */
    function is_number( number ) {
        return !isNaN( parseFloat( number ) )
            && isFinite( number );
    }

    /**
     * Get the total decimals from a number
     */
    function total_decimals( number ) {
        //Verify the number
        var match = ( '' + number )
            .match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
        if ( !match ) {
            return 0;
        }

        //Return the number
        return Math.max( 0,
            // Number of digits right of decimal point.
            ( match[1] ? match[1].length : 0 )
            // Adjust for scientific notation.
            - ( match[2] ? + match[2] : 0 )
        );
    }
