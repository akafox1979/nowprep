/*
@package Custom Error Log
@subpackage Includes

This file handles all the ajax used by the delete buttons in the error_log table.
*/

var $ = jQuery.noConflict();

/*
Load all functions when document is ready...
*/

$( document ).ready( function() {
	
	celDeleteSingle();
	celDeleteAll();
	celLogFilter();
	celAbToggle();

});
	
/*
Delete a single error when a delete button is clicked...
*/

function celDeleteSingle() {
	
	$( '.cel-delete-button' ).on( 'click', function() {
		
		/* Get log type... */
		console.log( 'yay' );
		
		if( $( this ).parent().parent().hasClass( 'cel-error' ) ) {
			
			log_type = 'error';
			
		}
		
		else {
			
			log_type = 'notice';
			
		}
		
		/* Delete the error visibily from the error log table... */
		var error_code = $( this ).attr( 'rel' );
		var deleted = '#'+log_type+'-'+error_code;
		
		/* Toggle class of all table rows after current to maintain the nice stripes... */
		$( deleted ).nextAll().toggleClass( 'cel-dark' );
		$( deleted ).hide();
		
		$( '#cel-ajax-message' ).html( '' ).append( '<div class="update-nag ajax-response">'+errorAjax.deleting+'</div>' );
		
		var nonce = $( this ).attr( 'data-nonce' );
		
		/* Now use an ajax call to delete the error from the wp_options table... */
		$.ajax({
		
	        type: 'POST',
	        url: errorAjax.ajaxurl,
	        data: {
	        
	            action: 'cel_delete_single',
	            error_code: error_code,
	            log_type: log_type,
	            nonce: nonce
	            
	        },
	        success: function( data, textStatus, XMLHttpRequest ) {
	        
	            $( '#cel-ajax-message' ).html( '' );
	            $( '#cel-ajax-message' ).append( data );
	            
	        },
	        error: function( MLHttpRequest, textStatus, errorThrown ) {
	        
	            alert( errorThrown );
	            
	        }
	        
	    });
		
	});
	
}

/*
Clear all errors when the delete all button is clicked
*/
	
function celDeleteAll() {
	
	$( '.cel-delete-all' ).on( 'click', function() {
		
		/* Delete all errors visibily from the error log table... */
		$( '.cel-table-row' ).hide();
		
		$( '#cel-ajax-message' ).html( '' ).append( '<div class="update-nag ajax-response">'+errorAjax.deleting+'</div>' );
		
		var nonce = $( this ).attr( 'data-nonce' );

		/* Now use an ajax call to delete all errors from the wp_options table... */	
		$.ajax({
		
	        type: 'POST',
	        url: errorAjax.ajaxurl,
	        data: {
	        
	            action: 'cel_delete_all',
	            nonce: nonce
	            
	        },
	        success: function( data, textStatus, XMLHttpRequest ) {
	        
	            $( '#cel-ajax-message' ).html( '' );
	            $( '#cel-ajax-message' ).append( data );
	            
	        },
	        error: function( MLHttpRequest, textStatus, errorThrown ) {
	        
	            alert( errorThrown );
	            
	        }
	        
	    });
		
	});

}

/*
Filter log to show only errors or notices
*/

function celLogFilter() {

	$( '.cel-log-filter' ).on( 'click', function() {
		
		/* Empty the log table... */
		$( '.cel-table tbody' ).html( '' ).append( '<tr><td>Filtering...</td></tr>' );
		
		/* Pass filter and nonce to ajax call... */
		var nonce = $( this ).attr( 'nonce' );
		var filter = $( this ).attr( 'filter' );
		
		$.ajax({
		
	        type: 'POST',
	        url: errorAjax.ajaxurl,
	        data: {
	        
	            action: 'cel_filter_log',
	            nonce: nonce,
	            filter: filter
	            
	        },
	        success: function( data, textStatus, XMLHttpRequest ) {
	        
	            $( '.cel-table tbody' ).html( '' );
	            $( '.cel-table tbody' ).append( data );
	            
	            /* Rebind event to delete buttons after ajax call */
				celDeleteSingle();
				
	        },
	        error: function( MLHttpRequest, textStatus, errorThrown ) {
	        
	            alert( errorThrown );
	            
	        }
	        
	    });
	
	});

}

/*
Toggles on and off the admin bar button...
*/

function celAbToggle() {
	
	$( '#cel_ab_show' ).change( function() {
		
		if( $( this ).is( ":checked" ) ) {
			
			var toggle_value = 1;
			$( '#wp-admin-bar-error-log' ).show();
			
		}
		
		else {
			
			var toggle_value = 0;
			$( '#wp-admin-bar-error-log' ).hide();
			
		}
		
		$.ajax({
		
	        type: 'POST',
	        url: errorAjax.ajaxurl,
	        data: {
	        
	            action: 'cel_ab_toggle',
	            update: toggle_value,
	            
	        },
	        success: function( data, textStatus, XMLHttpRequest ) {
				
	        },
	        error: function( MLHttpRequest, textStatus, errorThrown ) {
	        
	            alert( errorThrown );
	            
	        }
	        
	    });
		
	});
	
}

/*
Load function when the window has loaded...
*/

$( window ).on( 'load', function() {
	
	celHighlightNewLogs();

});

/*
celHighlightNewLogs() adds a bit of a flourish to new logs...
*/

function celHighlightNewLogs() {
	
	$( '.cel-new-log' ).each( function() {
		
		/* Find out if this is a dark row or not... */
		if( $( this ).is( '.cel-dark' ) ) {
			
			var color = '#e6e6e6';
			
		}
		
		else {
			
			var color = '#f1f1f1';
			
		}
		
		/* Store current item as var so we can use it in a timeout function... */
		var current = this;
		
		/* after 800ms convert the background color back to normal... */
		setTimeout( function(){
		
			$( current ).find( 'td' ).css( 'background', color );
		
		}, 800 );
		
	})
	
}