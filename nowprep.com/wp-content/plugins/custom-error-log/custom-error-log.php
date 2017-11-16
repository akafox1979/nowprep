<?php

/*
Plugin Name: Custom Error Log
Plugin URI: https://github.com/danbahrami/custom-error-log
Description: A tool for logging and monitoring custom errors, making debugging complex PHP a breeze. Each error can have its own error message making it a lot easier to pin down specific issues in your code.
Text Domain: custom-error-log
Domain Path: /languages
Author: Dan Bahrami
Version: 1.1.1
License: GPL2

When developing a Wordpress theme that imported and synced data with a MS Dynamics CRM I found that
standard PHP errors and notices did not contain enough detailed information to properly debug. This
was especially frustrating when using WP_CRON and trying to track errors that occured in the background. 
I developed this plugin so that anyone can log custom errors that contain useful, specific information
with the hope that it might be useful to the Wordpress community.

This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
that you can use any other version of the GPL.

@package Custom Error Log
@version 1.1
@author Dan Bahrami
@copyright Copyright (c) 2014, Dan Bahrami
@license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html

*/

class cel_load {
	
	function __construct() {
	
		/* Set the constants needed by the plugin. */
		add_action( 'plugins_loaded', array( &$this, 'cel_constants' ), 1 );

		/* Internationalize the text strings used. */
		add_action( 'plugins_loaded', array( &$this, 'cel_i18n' ), 2 );

		/* Load the functions files. */
		add_action( 'plugins_loaded', array( &$this, 'cel_includes' ), 3 );

		/* Register activation hook. */
		register_activation_hook( __FILE__, array( &$this, 'cel_activate' ) );
		
		/* Register deactivation hook. */
		register_deactivation_hook( __FILE__, array( &$this, 'cel_deactivate' ) );
		
	}
	
	function cel_constants() {
	
		/* Set constant path to the plugin directory. */
		define( 'CEL_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		
		/* Set constant path to the plugin URL. */
		define( 'CEL_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
		
	}
	
	function cel_i18n() {

		/* Load the translation of the plugin. */
		load_plugin_textdomain( 'custom-error-log', false, 'custom-error-log/languages' );
		
	}
	
	function cel_includes() {
		
		/* Include main functions file, this does all the hard work. */
		require_once( CEL_DIR . 'includes/functions.php');
		
		/* Include main admin file, this sets up the plugin's admin area */
		require_once( CEL_DIR . 'admin/admin.php');
		require_once( CEL_DIR . 'admin/admin-bar.php');
		
	}
	
	function cel_activate() {
		
		/* On activation create two fields in the wp_options table to store our errors and notices. */
		add_option( 'custom_error_log' );
		add_option( 'custom_notice_log' );
		add_option( 'cel_new_logs' );
		add_option( 'cel_ab_show', true );
		
	}
	
	function cel_deactivate() {
	
		/* On deactivation clear errors and notices from the database. */
		delete_option( 'custom_error_log' );
		delete_option( 'custom_notice_log' );
		delete_option( 'cel_new_logs' );
		delete_option( 'cel_ab_show' );
		
	}
	
}

$cel_load = new cel_Load();