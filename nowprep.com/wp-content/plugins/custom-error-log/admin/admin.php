<?php

/*
@package Custom Error Log
@subpackage Admin

This file sets up a page in the admin area under 'Tools' -> 'Error Log'.

Set up the management page...
*/

function cel_add_admin() {

	$cel_log_page = add_management_page( 
	
		__( 'Error Log', 'custom-error-log' ), 
		__( 'Error Log', 'custom-error-log' ), 
		'install_plugins', 
		'custom-error-log', 
		'cel_admin'
		
	);
	
	add_action( 'load-' . $cel_log_page, 'cel_load_log_table_scripts' );
	
}

add_action( 'admin_menu', 'cel_add_admin' );

/*
Require log-table.php which creates the output of the error log page...
*/

function cel_admin() {
	
	/* Import the main log table file... */
	require_once( CEL_DIR . 'admin/log-table.php' );
	
	/* Clear the new logs array as now all logs should have been seen... */
	update_option( 'cel_new_logs', null );
	
}

/*
Load scripts for the log table page...
*/

function cel_load_log_table_scripts() {

	add_action( 'admin_enqueue_scripts', 'cel_log_table_scripts' );
	
}

function cel_log_table_scripts() {
	
	wp_register_style( 'mainStyle', CEL_URI . 'css/style.css' );
	
	/* Enqueue script for the error log table and pass translatable strings to it... */
	wp_register_script( 'logTable', CEL_URI . 'js/logTable.js', array( 'jquery' ), '', TRUE );
	
	$data_array = array(
	
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'deleting' => __( 'Deleting', 'custom-error-log' ) . '...'
			
	);
	
	wp_localize_script( 'logTable', 'errorAjax', $data_array );
	
	if( is_admin() ) {
	
		wp_enqueue_style( 'mainStyle');
		wp_enqueue_script( 'logTable' );
		
	}
	
}