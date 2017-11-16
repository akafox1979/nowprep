<?php 

/*
@package Custom Error Log
@subpackage Admin

This file holds the output for the admin error log under the 'Tools' menu.
*/

$logs = cel_get_all_logs();

/* Find out if the user has selected to see the admin menu icon... */
$ab_show = get_option( 'cel_ab_show', true );

$ab_checked = null;

if( $ab_show == true ) {
	
	$ab_checked = 'checked';
	
}

?>
		
<div class="wrap" id="error-log">
	
	<div id="cel-log-table-header" class="clearfix">
	
		<h2 class="cel-title"><?php _e( 'Error Log' , 'custom-error-log' ); ?></h2>
		
		<form id="cel-ab-toggle" method="post" action="">
			
			<label><?php _e( 'Show in the admin bar', 'custom-error-log' ); ?></label>
					
			<input type="checkbox" name="cel_ab_show" id="cel_ab_show" <?php echo $ab_checked; ?> />
					
		</form>
		
	</div>
	
	<hr style="margin-bottom: 15px;">

	<div id="cel-ajax-message"></div>

	<?php
	
	/* If there are any logs create the log table... */
	if( $logs && $logs['logs'] ) {
		
		$nonce = wp_create_nonce( 'cel_nonce' );
		
		/* If there are both notices and errors output filter buttons... */
		if( $logs['have_both'] == true ) { ?>
			
			<a class="cel-log-filter" filter="all" nonce="<?php echo $nonce; ?>">
			
				<?php _e( 'All', 'custom-error-log' ); ?>
			
			</a> |
			
			<a class="cel-log-filter" filter="error" nonce="<?php echo $nonce; ?>">
				
				<?php _e( 'Errors', 'custom-error-log' ); ?>
				
			</a> |

			<a class="cel-log-filter" filter="notice" nonce="<?php echo $nonce; ?>">
				
				<?php _e( 'Notices', 'custom-error-log' ); ?>
				
			</a>

		<?php } ?>
		
		<a class="cel-delete-all" data-nonce="<?php echo $nonce; ?>"><?php _e( 'Clear Log', 'custom-error-log' ); ?></a>
		
		<table class="cel-table">
		
			<thead>
	
				<tr>
			    	
			    	<th class="cel-type"></th>
			    
			    	<th class="cel-date"><?php _e( 'Date', 'custom-error-log' ); ?></th>
			    	
			    	<th class="cel-time"><?php _e( 'Time', 'custom-error-log' ); ?></th>
			    	
			    	<th class="cel-message"><?php _e( 'Message', 'custom-error-log' ); ?></th>
			    	
					<th class="cel-delete"></th>
	
				</tr>
	
			</thead>
	    
			<tbody>
			
				<?php
				
				/* Output all logs into the table... */
				echo cel_format_logs( $logs, $nonce );
	
				?>

			</tbody>
	    	
		</table>
        
	<?php 
	
	}
	
	/* If there are no logs output the introduction text from introduction.php... */
	else { 

		include( CEL_DIR . '/admin/introduction.php' );

	} 
	
	?>

</div>