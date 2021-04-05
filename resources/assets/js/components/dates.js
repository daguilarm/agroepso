/**
 *
 * ////////////////////////////
 * ////// * Date and time Functions * //////
 * ////////////////////////////
 *
 */

    export default {
        dateToInternational: dateToInternational,
    };

    /** 
    * Convert date from spanish format to international format
    */
    function dateToInternational( date ) {
        var formatDate = date.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$2-$1");
            return new Date( formatDate );
    };