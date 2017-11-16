<?php
/*
Plugin Name: MiwoSQL
Plugin URI: http://miwisoft.com
Description: MiwoSQL is a simple and fast database management component. It operates executing SQL queries so you don't have to access phpMyAdmin anymore.
Author: Miwisoft
Version: 1.0.6
Author URI: http://miwisoft.com
Plugin URI: http://miwisoft.com/wordpress-plugins/miwosql-wordpress-database-manager
*/

defined('ABSPATH') or die('MIWI');

if (!class_exists('MWordpress')) {
    require_once(dirname(__FILE__) . '/wordpress.php');
}

final class MiSQL extends MWordpress {

    public function __construct() {
	    if (!defined('MURL_MIWOSQL')) {
		    define('MURL_MIWOSQL', plugins_url('', __FILE__));
	    }

	    if (!defined('MIWOSQL_PACK')) {
		    define('MIWOSQL_PACK', 'lite');
	    }

        parent::__construct('miwosql', '33.0098', false);
    }

    public function initialise() {
        $miwi = MPATH_WP_CNT.'/miwi/initialise.php';

        if (!file_exists($miwi)) {
            return false;
        }

        require_once($miwi);

        $this->app = MFactory::getApplication();

        $this->app->initialise();

		#cvs export start
        $option = MRequest::getString('option');
        $task = MRequest::getString('task');

        if(!empty($task) and !empty($option) and $task == 'csv' and $option == 'com_miwosql') {
			MFactory::getLanguage()->load('com_'.$this->context, MPATH_ADMINISTRATOR);
            MComponentHelper::renderComponent('com_miwosql');
        }
		#cvs export end
    }

}

$misql = new MiSQL();

register_activation_hook(__FILE__, array($misql, 'activate'));
register_activation_hook(__FILE__, array($misql, 'deactivate'));