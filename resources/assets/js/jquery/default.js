//Datepicker
import flatpickr from "flatpickr"
import Spanish from "flatpickr/dist/l10n/es.js";
import forms from '../components/forms.js';

(function () {
	"use strict";

	//Activate bootstrip tooltips
	$( "[data-toggle='tooltip']" ).tooltip();

	//Scroll to top
	var viewPortWidth = $( window ).width();

	$( window ).scroll(function(event) {
		event.preventDefault();
		if ( viewPortWidth > 480 ) {
			if ( $( this ).scrollTop() > 180 ) {
				$( '.scrollTo-top' ).fadeIn();
			} else {
				$( '.scrollTo-top' ).fadeOut();
			}
		}
	});

	$( '.scrollTo-top' ).click( function( event ) {
		$( 'html, body' ).animate( {scrollTop : 0 }, 600 );
		event.preventDefault();
	});

	//Activate datepicker
	$( "[data-toggle='datepicker']" ).flatpickr({
		dateFormat: 'd/m/Y',
		locale: 'es',
	});

	/**
	* Configure the date, time, zip and numbers
	*/
	if ( $.jMaskGlobals ) {
		if ( $( '.year') ) {
			$( '.year' )
			.mask( '0000', { placeholder: 'AAAA' } );
		}

		if ( $( '.date') ) {
			$( '.date' )
			.mask( '00/00/0000', { placeholder: '__/__/____' } );
		}
	}

	if ( $( '.number') ) {
		$( '.number' ).inputNumberFormat({ 'decimalAuto': 2, 'separator': '.' });
	}

	/**
	 * Add required class if the required field is activated
	 */
	 $( 'form' ).not( '#login' ).find( 'input, select, textarea' ).each(function() {
	 	if ( $( this ).prop( 'required' ) ) {
	 		$( this ).prev( 'label.control-label' ).addClass( 'label-required' );
	 		$( this ).parent( 'div' ).prev( 'label.control-label' ).addClass( 'label-required' );
	 	}
	 });

	/**
	* Limit the textareas length
	*/
	if( $( 'textarea' ) ) {
		$( 'textarea' )
		.on( 'keyup', forms.text_area );
	}

	/**
	* Print table
	*/
	if( $( '#button-print' ) ) {
		$( '#button-print' ).on( 'click', function() {

			var printDefaultTitle = $( this ).data( 'title' );

			$( "#tableDataId" ).print({
				globalStyles: true,
				mediaPrint: true,
				stylesheet: null,
				noPrintSelector: ".no-print",
				iframe: true,
				append: null,
				prepend: '<h2>' + printDefaultTitle + '</h2><br>',
				manuallyCopyFormValues: true,
				deferred: $.Deferred(),
				timeout: 750,
				title: printDefaultTitle,
				doctype: '<!doctype html>'
			});
		});
	}

	//Modal info
	if( $( '.modal-info' ) ) {
		$( '.modal-info' ).on( 'click', function( event ) {

			event.preventDefault();
			var url = $( this ).parent().attr( 'href' );
			var title = $( this ).parent().data( 'title' );

			$( '#modal-info-title' ).find('span').html( title );
			$( '#modal-info' ).modal('show');

			$.ajax({
				url: url,
				type: 'GET',
			}).done(function( data ) {
				$( '#modal-info-body' ).html( data );
			});
		});
	};

	//Modal delete
	if( $( '.modal-delete' ) ) {
		$( '.modal-delete' ).on( 'click', function ( event ) {
			event.preventDefault();

			//Update form action
			var url = $(this).parent().attr( 'href');
			$( '#form-delete' ).attr( 'action', url );
		})
	};

	//Submit form from index
	if( $( '.button-submit' ) ) {
		$( '.button-submit' ).on( 'click', function ( event ) {
			event.preventDefault();

			$( '#form-submit' ).submit();
		})
	};

	//Tabs
	$('.tab-pane input').on('invalid', function(){
	   // Find the tab-pane that this element is inside, and get the id
	   var $closest = $(this).closest('.tab-pane');
	   var id = $closest.attr('id');

	   // Find the link that corresponds to the pane and have it show
	   $('.nav a[href="#' + id + '"]').tab('show');
	});
})();
