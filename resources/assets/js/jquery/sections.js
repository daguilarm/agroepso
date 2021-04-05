import forms from '../components/forms.js';

(function () {
	/**
	* Select: Region
	*/
	if( $( '#state_id' ).length ) {
	    $( '#state_id' ).on( 'change', function( e ) {
	        e.preventDefault();
	        //Define the variables
	        var $container = $( '#region_id' ), $value = $( '#state_id' ).val(), $route = '/dashboard/ajax/regions';
	        //Generate the combobox: states > regions
	       if( $container.length ) {
	           forms.form_comboBox( $container, $value, $route );
	       }
	    });
	}

	/**
	* Select: Plant
	*/
	if( $( '#client_id' ).length && $( '#plant_id' ).length) {
	    $( '#client_id' ).on( 'change', function( e ) {
	        e.preventDefault();
	        //Default values
	        $( '#plant_id' ).empty(), $( '#warehouse_id' ).empty();
	        //Define the variables
	        var $container = $( '#plant_id' ), $value = $( '#client_id' ).val(), $route = '/dashboard/ajax/plants';
	        //Generate the combobox: states > regions
	       if( $container.length ) {
	           forms.form_comboBox( $container, $value, $route, false );
	       }
	    });
	}

	/**
	* Select: Warehouse
	*/
	if( $( '#plant_id' ).length && $( '#client_id' ).length && $( '#warehouse_id' ).length) {
	    $( '#plant_id' ).on( 'change', function( e ) {
	        e.preventDefault();
	        //Default values
	        $( '#warehouse_id' ).empty();
	        //Define the variables
	        var $container = $( '#warehouse_id' ), $value = $( '#plant_id' ).val(), $route = '/dashboard/ajax/warehouses';
	        //Generate the combobox: states > regions
	       if( $container.length ) {
	           forms.form_comboBox( $container, $value, $route, false );
	       }
	    });
	}

	/**
	* Select: Client Total Reference
	*/
	if( $( '#client_id' ).length && ($( '#warehouse_ref' ) || $( '#plant_ref' ) || $( '#user_ref' ) || $( '#plot_ref' ))) {
	    $( '#client_id' ).on( 'change', function( e ) {
	        e.preventDefault();
	        //Default value
	        var item = $( this );
	        var value = item.val();
	        var field = item.data( 'model' );

	        if(!field) {
	        	return false;
	        }

	        //Get the totals
	        $.get( window.location.origin + '/dashboard/ajax/total', { id: value, field: field },
	        function( data ) {
	        	console.log(data);
	        	$( '#plot_ref' ).val( data );
	            $( '#warehouse_ref' ).val( data );
	            $( '#plant_ref' ).val( data );
	            $( '#user_ref' ).val( data );
	        });
	    });
	}

	/**
	* Select: Crop variety
	*/
	if( $( '#client_id' ).length && $( '#crop_variety_id' )) {
	    $( '#client_id' ).on( 'change', function( e ) {
	    	 e.preventDefault();
	    	 //Default values
	    	 $( '#crop_variety_id' ).empty();
	    	 //Define the variables
	    	 var $container = $( '#crop_variety_id' ), $value = $( '#client_id' ).val(), $route = '/dashboard/ajax/crops';
	    	 //Generate the combobox: states > regions
	    	if( $container.length ) {
	    	    //Add loading class
	    	    $container.empty().addClass( 'loading' );
	    	    //Get the data via AJAX
	    	    $.get( window.location.origin + $route, { search: $value },
	    	    function( data ) {
	    	        //Generate the form select
	    	        if( data.length > 0 ) {
	    	            //First empty option field
	    	            $container.append( $( '<option>', { value: '', text : '' } ) );
	    	            //Built the select
	    	            $.each( data, function( index, element ) {
	    	                $container.append( $( '<option>', {
	    	                    value: element.id,
	    	                    text: element.crop_variety_name,
	    	                    'data-crop': element.crop_id,
	    	                    'data-type': element.crop_variety_type
	    	                }));
	    	            });
	    	            //Remove loading class, and enable the container
	    	            $container
	    	                .prop( 'required', false )
	    	                .removeClass( 'loading' );
	    	        } else {
	    	            //Remove loading class, and disable the container
	    	            $container
	    	                .prop( 'required', false )
	    	                .removeClass( 'loading' );
	    	        }
	    	    });
	    	}
	    });
	}

	/**
	* Select: Crop variety type
	*/
	if( $( '#client_id' ).length && $( '#crop_variety_id' ) && $( '#crop_variety_type' )) {
	    $( '#crop_variety_id' ).on( 'change', function( e ) {
	    	e.preventDefault();
	    	var $selected = $( this ).find( ':selected' );
	    	var variety = $selected.data( 'type' );
	    	if(variety) {
	    		$( '#crop_variety_type' ).val( $selected.data( 'type' ) );
	    	}
	    });
	};

	/**
	* Select: Client with crops values
	*/
	if( $( '#client_id' ) && $( '#crop_name' ) ) {
	    $( '#client_id' ).on( 'change', function( e ) {
	    	 e.preventDefault();

	    	 //Select crops
	    	var $selected = $( this ).find( ':selected' );
	    	$( '#crop_name' ).val( $selected.data( 'crop' ) );
	    	$( '#crop_id' ).val( $selected.data( 'id' ) );

	    	//Select users
			var $container = $( '#user_id' ), $value = $( '#client_id' ).val(), $route = '/dashboard/ajax/users';
			//Generate the combobox: client > users
			if( $container.length ) {
				forms.form_comboBox( $container, $value, $route );
	    	}
	    });
	}

	/**
	* Select: plot areas
	*/
	if( $( '#plot_area' ) && $( '#plot_percent_cultivated_land') ) {
		$( '#plot_area, #plot_percent_cultivated_land' ).on( 'keyup', function() {

		    //Default values
		    var area = parseFloat( $( '#plot_area' ).val().replace( ',', '.' ) );
		    var percent = parseFloat( $( '#plot_percent_cultivated_land' ).val().replace( ',', '.' ) );

		    //Operation
		    var operation = ( area * percent ) / 100;

		    //With two decimals
		    $( '#plot_real_area' ).val( parseFloat( operation || 0 ).toFixed( 2 ) );
		});
	}
})();
