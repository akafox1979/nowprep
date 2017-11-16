<?php
require_once('classes/ThreadTask.php');
error_reporting(0);

$arraylist = array(

    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-12-01&endtime=1997-01-01",
    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-11-01&endtime=1996-12-01",
    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-10-01&endtime=1996-11-01",
    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-09-01&endtime=1996-10-01",
    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-08-01&endtime=1996-09-01",
    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-07-01&endtime=1996-08-01",
    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-06-01&endtime=1996-07-01",
    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-05-01&endtime=1996-06-01",
    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-04-01&endtime=1996-05-01",
    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-03-01&endtime=1996-04-01",
    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-02-01&endtime=1996-03-01",
    API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=1996-01-01&endtime=1996-02-01",

);

$stack = array();

foreach ( $arraylist as $item ) {
    $stack[] = new ThreadTask($item);
}

foreach ( $stack as $t ) {
    $t->start();
}
