<?php

/*
@package Custom Error Log
@subpackage Admin

This file adds a menu icon to the admin toolbar for users to easily get back to the error log.
*/

function cel_add_admin_bar() {

	global $wp_admin_bar, $wpdb;
	
	/* Check that the admin bar is showing and user has permission... */
	if ( !current_user_can( 'edit_themes' ) || !is_admin_bar_showing() ) {
		
		return;
		
	}
	
	/* Get logs... */
	$new_logs = get_option( 'cel_new_logs', true );
	
	/* Start building content for the admin bar icon... */
	$content = '';
	
	/* Add the errors section... */
	if( $new_logs && $new_logs['errors'] ) {
	    
	    $error_count = count( $new_logs['errors'] );
	    $class = 'cel-ab-section';
	    
	}
	
	else {
	    
	    $error_count = '0';
	    $class = 'cel-ab-section cel-no-logs';
	    
	}
	
	$content .= '<div id="cel-ab-errors" class="' . $class . '">';
	$content .= '<span class="ab-icon"></span>';
	$content .= '<span class="ab-label">' . $error_count . '</span>';
	$content .= '</div>';
	
	/* Add the notices section... */
	if( $new_logs && $new_logs['notices'] ) {
	    
	    $notice_count = count( $new_logs['notices'] );
	    $class = 'cel-ab-section';
	    
	}
	
	else {
	    
	    $notice_count = '0';
	    $class = 'cel-ab-section cel-no-logs';
	    
	}
	
	$content .= '<div id="cel-ab-notices" class="' . $class . '">';
	$content .= '<span class="ab-icon"></span>';
	$content .= '<span class="ab-label">' . $notice_count . '</span>';
	$content .= '</div>';
	
	/* If there are no logs rewrite the content to just placeholder text... */
	if( $error_count === '0' && $notice_count === '0' ) {
		
		$content = '<span class="cel-ab-no-logs">' . __( 'Errors', 'custom-error-log' ) . '</span>';
		
	}

	
	/* Check that the user has selected to show the admin icon... */
	$show_icon = get_option( 'cel_ab_show', true );
	
	if( $show_icon == false ) {
		
		$class = 'cel-ab-hidden';
		
	}
	
	else {
		
		$class = null;
		
	}
	
	/* Add the main siteadmin menu item */
	$wp_admin_bar->add_menu(
		
		array(
		
			'parent'	=> false,
			'id'		=> 'error-log',
			'title'		=> $content,
			'href'		=> admin_url( 'tools.php?page=custom-error-log' ),
			'meta'		=> array(
			
				'class'		=> $class
				
			)
			
		)
	
	);
	
}

add_action( 'admin_bar_menu', 'cel_add_admin_bar', 1000 );

/*
cel_admin_bar_style() adds a bit of style to the admin bar icon...
*/

function cel_admin_bar_style() {
	
	wp_register_style( 'celAbStyle', CEL_URI . 'css/ab-style.css' );
	
	if( is_admin_bar_showing() ) {
		
		wp_enqueue_style( 'celAbStyle' );
		
	}
	
}

add_action( 'wp_head', 'cel_admin_bar_style' );
add_action( 'admin_head', 'cel_admin_bar_style' );