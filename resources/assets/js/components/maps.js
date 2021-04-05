/**
 *
 * ////////////////////////////
 * ////// * Geolocation Functions  * //////
 * ////////////////////////////
 *
 */

    export default {
        generateMap: generateMap,
        sigPac: sigPac,
        searchMap: searchMap,
        getVariable: getVariable,
    };

    /////////////////////
    // Map variables
    /////////////////////            
    var zoom                    = 7;   
    var zoomSearch              = 15;
    var zoomPlots               = 17;
    var maxZoom                 = 18;
    var lat                     = 40.4469;
    var lng                     = -3.6914;
    //Icons
    L.Icon.Default.imagePath    = window.location.origin + '/images/';

    /////////////////////
    // Map functions
    ///////////////////// 
    //Generate a new map   
    function generateMap(customLat, customLng, customZoon, mapContainer) {
        var map = new L.Map( mapContainer || 'map' ).setView( new L.LatLng( customLat || lat, customLng || lng ), customZoon || zoom, { animation: true } );
        //Remove options from the map
        var disableControlsFromMap = disableControls( map );
        //Set PNOA layer
        var base = L.tileLayer.wms( '//www.ign.es/wms-inspire/pnoa-ma', {
            attribution:    '<a href="http://www.ign.es" target="_blank">© Instituto Geográfico Nacional</a>',
            layers:         'OI.OrthoimageCoverage',
            format:         'image/jpeg',
            transparent:    false,
            version:        '1.3.0',
            crs:            L.CRS.EPSG4326,
            maxZoom:        maxZoom
        }).addTo( map );
        //Return the map value
        return map;
    }

    //Add a sigpac layer
    function sigPac( map ) {
        return L.tileLayer.wms( '//wms.magrama.es/wms/wms.aspx', {
            attribution:    '<a href="http://www.magrama.gob.es/es/" target="_blank">SIGPAC ©</a>',
            layers:         'PARCELA',
            format:         'image/png',
            transparent:    true,
            version:        '1.1.0',
            crs:            L.CRS.EPSG4326
        });
    }

    //Search GPS in a map
    function searchMap( map, lat, lng ) {
        //If there is a place to locate...
        if( $( '#city_id' ).val() ) {
            //Set the new location
            map.setView( new L.LatLng( lat, lng ), zoomSearch, { animation: true } );
            enableControls( map );
        } 
    }

    //Disable all controls from map
    function disableControls( map ) {
        //Remove options from the map
        map.dragging.disable();
        map.touchZoom.disable();
        map.doubleClickZoom.disable();
        map.scrollWheelZoom.disable();
        map.keyboard.disable();
        $( '.leaflet-control-zoom' ).css( 'visibility', 'hidden' );
    }

    //Enable all controls from map
    function enableControls( map ) {
        // Enable drag and zoom handlers.
        map.dragging.enable();
        map.touchZoom.enable();
        map.doubleClickZoom.enable();
        map.scrollWheelZoom.enable();
        map.keyboard.enable();
        $( '.leaflet-control-zoom' ).css( 'visibility', 'visible' );
    }

    // Get the variable
    function getVariable(variable) {
        return eval(variable);
    }