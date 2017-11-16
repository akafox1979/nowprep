<?php

//var_dump($_POST);die();
include_once(__DIR__ . '/../../../../wp-config.php');
include_once(__DIR__ . '/../../../../wp-includes/wp-db.php');
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../classes/class.WunderGround.php');

$total_data_count = 0;
if (isset($_POST['zipcode']))
    $zipcode = $_POST['zipcode'];
else if (isset($_GET['zip']))
    $zipcode = $_GET['zip'];
else $zipcode = "";

if (isset($_POST['radius']))
    $radius = $_POST['radius'];
else if (isset($_GET['radius']))
    $radius = $_GET['radius'];
else $radius = 3;

if (isset($_POST['date_start']))
    $date_start = $_POST['date_start'];
else if (isset($_GET['date_start']))
    $date_start = $_GET['date_start'];
else $date_start = date('m/01/Y');

if (isset($_POST['date_end']))
    $date_end = $_POST['date_end'];
else if (isset($_GET['date_end']))
    $date_end = $_GET['date_end'];
else $date_end = date('m/t/Y');

$zip_coord = array('longitude' => 0, 'latitude' => 0);

global $wpdb;

if (!empty($zipcode)) {
    $outputInfo = "";

    $wunderground = new WunderGround();

    $zip_coord = $wunderground->getCoordByZip($zipcode);
    $outputInfo .= "<script> coord = " . json_encode($zip_coord) . ";</script>";

    $zip_info = $wunderground->getInfoByZip($zipcode);

    $outputInfo .= "";
//    $outputInfo .= "<h1 class='total-data'></h1>";
//    $outputInfo .= "<br>";
    $outputInfo .= "<div style='display:none;' id='map'></div>";
//    $outputInfo .= "<br>";

    if($_POST['st'] == 1) {
        //$radius = 3;
        $radius += 3;
        if (count($zip_info) > 0) {
            $outputInfo .= "<div>County - " . $zip_info['county_name'] . "</div>";
            $outputInfo .= "<div>State - " . $zip_info['state_name'] . " (" . $zip_info['state_code'] . ")" . "</div>";
        }
        $outputInfo .= "<h3 style='padding-top: 50px;'>MOST RECENTLY/CLOSEST PROXIMITY</h3>";
    } else {
        $radius += 10;
        $outputInfo .= "<h3 style='padding-top: 0px;'>CLOSEST PROXIMITY</h3>";
    }
    $outputInfo .= "<table>";
    $outputInfo .= "<thead>";
    $outputInfo .= "<tr>";
    $outputInfo .= "<td style='width: 10%;'>Type</td>";
    $outputInfo .= "<td style='width: 30%;'>Date/Time</td>";
    $outputInfo .= "<td style='width: 30%;'>Title</td>";
    $outputInfo .= "<td style='width: 30%;'>Options</td>";
    $outputInfo .= "</tr>";
    $outputInfo .= "</thead>";
    $outputInfo .= "<tbody>";

    $outputData = array();

    $eqs = $wunderground->getEarthquakeFromDBByZip($zipcode, $radius, $date_start, $date_end);
    if (count($eqs) > 0) {
        if (is_array($eqs)) {
            $markers_array = array();
            foreach ($eqs as $eq) {
                if (is_object($eq)) {
                    $total_data_count++;
                    array_push($markers_array, array('title' => $eq->getTitle(), 'coord' => $eq->getCoordinates()));
                    array_push($outputData, array("type"=>"Earthquake","date"=>$eq->getTimes(),"title"=>$eq->getTitle(),"text"=>"Magnitude: " . $eq->getMag()));
                }
            }
            $outputInfo .= "<script> myLatlng =" . json_encode($markers_array) . ";</script>";
        }
    }

    $alerts = $wunderground->getAlertsFromDBByZip($zipcode, $radius, $date_start, $date_end);
    if (count($alerts) > 0) {
        if (is_array($alerts)) {
            foreach ($alerts as $alert) {
                if (is_object($alert)) {
                    $total_data_count++;
                    array_push($outputData, array("type"=>$alert->getType(),"date"=>$alert->getExpires(),"title"=>$alert->getTypeDescription(),"text"=>"<span class='short-message'>" . substr($alert->getMessage(), 0, 150) . " ... <a href='#' class='show-more'>More</a></span><span class='full-message'>" . $alert->getMessage() . " <a href='#' class='hide-more'>Less</a></span>"));
                }
            }
        }
    }
    $disasterTypes = $wunderground->getDisasterTypesByZip($zipcode);
    foreach ($disasterTypes as $disasterType) {
        $disasters = $wunderground->getDisastersByType($disasterType, $zipcode, $radius, $date_start, $date_end);
        if (count($disasters) > 0) {
            if ($disasters != null) {
                foreach ($disasters as $disaster) {
                    if (is_object($disaster)) {
                        $total_data_count++;

                        array_push($outputData, array("type"=>$disaster->getIncidentType(),"date"=>$disaster->getIncidentBeginDate(),"title"=>$disaster->getTitle(),"text"=>$disaster->getDeclaredCountyArea()));
                    } else {
                        break;
                    }
                }
            }
        }
    }

    function build_sorter($key) {
        return function ($a, $b) use ($key) {
            return strnatcmp($a[$key],$b[$key]);
        };
    }

    usort($outputData, build_sorter('date'));


    foreach ($outputData as $outData) {
        $outputInfo .= "<tr>";
        $outputInfo .= "<td>" . $outData["type"] . "</td>";
        $outputInfo .= "<td>" . $outData["date"] . "</td>";
        $outputInfo .= "<td>" . $outData["title"] . "</td>";
        $outputInfo .= "<td>" . $outData["text"] . "</td>";
        $outputInfo .= "</tr>";
    }

    $outputInfo .= "</tbody>";
    $outputInfo .= "</table>";
    echo $outputInfo;
}
?>