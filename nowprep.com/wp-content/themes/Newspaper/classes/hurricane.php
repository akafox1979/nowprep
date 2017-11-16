
<?php
require_once('../config/config.php');
require_once('class.WunderGround.php');

global $wpdb;

$wunderground = new WunderGround();
if( $wpdb) {
    $eqs = $wunderground->getCurrentHurricanes();
}