<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bitnami_wordpress');

/** MySQL database username */
define('DB_USER', 'bn_wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'c089b008e3');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'ea27c8fd5741f7cc41c50696f4a39f8028817a194d218d4459676376f4a07909');
define('SECURE_AUTH_KEY', '29bf898f33393d388e1d74e4e84364cf452d000cf278a6fb0fbf95eead9684c6');
define('LOGGED_IN_KEY', 'b6cf79a85592310998ceb9f13a5ce114f51f09fc89eecbddb033e07d51df9ca5');
define('NONCE_KEY', '29f40df769c4d0781dad8121dc8df24fe56625658361e4489bceb5234032bf41');
define('AUTH_SALT', '708021949bde73d5d48726a398ae76cbd3730a7bfacefe0af16e04c9e6e3fc3a');
define('SECURE_AUTH_SALT', '9521fb0f069a1591fd630db54c82f302563dfb4e308f30c3910c7b1a30e550c7');
define('LOGGED_IN_SALT', '57abff3687808448690cf90ad0a6e0a6068e373f036359b6ab5ba949ede6eda3');
define('NONCE_SALT', '4cc9d8de3857f4c1973511a80925d67134e514cf915af99eb5386b9d699aad99');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
//define( 'WP_DEBUG', true );
//define( 'WP_DEBUG_DISPLAY', false );
//define( 'WP_DEBUG_LOG', true );

/* That's all, stop editing! Happy blogging. */
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
*/

//define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/');
//define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/');

define('WP_SITEURL', 'https://start.nowprep.com/');
define('WP_HOME', 'https://start.nowprep.com/');

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_TEMP_DIR', '/opt/bitnami/apps/wordpress/tmp');


define('FS_METHOD', 'direct');


//  Disable pingback.ping xmlrpc method to prevent Wordpress from participating in DDoS attacks
//  More info at: https://docs.bitnami.com/?page=apps&name=wordpress&section=how-to-re-enable-the-xml-rpc-pingback-feature

// remove x-pingback HTTP header
add_filter('wp_headers', function($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});
// disable pingbacks
add_filter( 'xmlrpc_methods', function( $methods ) {
        unset( $methods['pingback.ping'] );
        return $methods;
});
add_filter( 'auto_update_translation', '__return_false' );

set_time_limit(0);
