/**
 *
 * ////////////////////////////
 * ////// * General functions * //////
 * ////////////////////////////
 *
 */

 /**
 * Convert string to studly case
 */
 window.studly_case =  function( str ) {
    var i;
    var newstr = str.split("_");

    for( i = 0; i < newstr.length; i++ ) {
       if( newstr[ i ] == "" ) continue;
       var copy = newstr[ i ].substring( 1 ).toLowerCase();
       newstr[ i ] = newstr[ i ][ 0 ].toUpperCase() + copy;
   }

   newstr = newstr.join("");

   return newstr;
 }
