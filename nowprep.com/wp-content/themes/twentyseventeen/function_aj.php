<?php

//var_dump($_POST);die();
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
else $radius = 0;

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

//    $zip_coord = $wunderground->getCoordByZip($zipcode);

//    $outputInfo .= "<script> coord = " . json_encode($zip_coord) . ";</script>";

    //$zip_info = $wunderground->getInfoByZip($zipcode);

//    $outputInfo .= "County - " . $zip_info['county_name'] . "<br>";
//    $outputInfo .= "State - " . $zip_info['state_name'] . " (" . $zip_info['state_code'] . ")" . "<br>";

    $outputInfo .= "";
    $outputInfo .= "<h1 class='total-data'></h1>";
    $outputInfo .= "<br>";
    $outputInfo .= "<div id='map'></div>";
    $outputInfo .= "<br>";

    $eqs = array();//$wunderground->getEarthquakeFromDBByZip($zipcode, $radius, $date_start, $date_end);
    if (count($eqs) > 0) {
        $outputInfo .= "<h3 style='text-align: center;'>Earthquake from usgs.com <span class='total-data-items'>(" . count($eqs) . " Earthquakes)</span></h3>";
        $outputInfo .= "<table>";
        $outputInfo .= "<thead>";
        $outputInfo .= "<tr>";
        $outputInfo .= "<td style='width: 30%;'>Time</td>";
        $outputInfo .= "<td style='width: 65%;'>Title</td>";
        $outputInfo .= "<td style='width: 5%;'>Magnitude</td>";
        $outputInfo .= "</tr>";
        $outputInfo .= "</thead>";
        $outputInfo .= "<tbody>";

        if (is_array($eqs)) {
            $markers_array = array();
            foreach ($eqs as $eq) {
                if (is_object($eq)) {
                    $total_data_count++;
                    array_push($markers_array, array('title' => $eq->getTitle(), 'coord' => $eq->getCoordinates()));
                    $outputInfo .= "<tr>";
                    $outputInfo .= "<td>" . $eq->getTimes() . "</td>";
                    $outputInfo .= "<td>" . $eq->getTitle() . "</td>";
                    $outputInfo .= "<td>" . $eq->getMag() . "</td>";
                    $outputInfo .= "</tr>";
                }
            }
            $outputInfo .= "<script> myLatlng =" . json_encode($markers_array) . ";</script>";
        }
        $outputInfo .= "</tbody>";
        $outputInfo .= "</table>";
        $outputInfo .= "<br><br>";
    }

    $alerts = array();//$wunderground->getAlertsFromDBByZip($zipcode, $radius, $date_start, $date_end);
    if (count($alerts) > 0) {
        $outputInfo .= "<h3 style='text-align: center;'>Alerts from wunderground.com <span class='total-data-items'>(" . count($alerts) . " Alerts)</span></h3>";
        $outputInfo .= "<table>";
        $outputInfo .= "<thead>";
        $outputInfo .= "<tr>";
        $outputInfo .= "<td style='width: 5%;'>Type</td>";
        $outputInfo .= "<td style='width: 10%;'>Description</td>";
        $outputInfo .= "<td style='width: 15%;'>Date</td>";
        $outputInfo .= "<td style='width: 15%;'>Expires</td>";
        $outputInfo .= "<td style='width: 55%;'>Message</td>";
        $outputInfo .= "</tr>";
        $outputInfo .= "</thead>";
        $outputInfo .= "<tbody>";

        if (is_array($alerts)) {
            foreach ($alerts as $alert) {
                if (is_object($alert)) {
                    $total_data_count++;
                    $outputInfo .= "<tr>";
                    $outputInfo .= "<td>" . $alert->getType() . "</td>";
                    $outputInfo .= "<td>" . $alert->getTypeDescription() . "</td>";
                    $outputInfo .= "<td>" . $alert->getDate() . "</td>";
                    $outputInfo .= "<td>" . $alert->getExpires() . "</td>";
                    $outputInfo .= "<td><span class='short-message'>" . substr($alert->getMessage(), 0, 150) . " ... <a href='#' class='show-more'>More</a></span><span class='full-message'>" . $alert->getMessage() . " <a href='#' class='hide-more'>Less</a></span></td>";
                    $outputInfo .= "</tr>";
                }
            }
        }
        $outputInfo .= "</tbody>";
        $outputInfo .= "</table>";
        $outputInfo .= "<br><br>";
    }
    $disasterTypes = array();//$wunderground->getDisasterTypesByZip($zipcode);
    foreach ($disasterTypes as $disasterType) {
        $disasters = $wunderground->getDisastersByType($disasterType, $zipcode, $radius, $date_start, $date_end);
        if (count($disasters) > 0) {

            $outputInfo .= "<h3 style='text-align: center;'>" . $disasterType . "<span class='total-data-items'>(" . count($disasters) . " " . $disasterType . " )</span></h3>";
            $outputInfo .= "<table>";
            $outputInfo .= "<thead>";
            $outputInfo .= "<tr>";
            $outputInfo .= "<td style='width: 10%;'>Incident Type</td>";
            $outputInfo .= "<td style='width: 30%;'>Title</td>";
            $outputInfo .= "<td style='width: 20%;'>County</td>";
            $outputInfo .= "<td style='width: 20%;'>Incident Begin Date</td>";
            $outputInfo .= "<td style='width: 20%;'>Incident End Date</td>";
            $outputInfo .= "</tr>";
            $outputInfo .= "</thead>";
            $outputInfo .= "<tbody>";
            if ($disasters != null) {
                foreach ($disasters as $disaster) {
                    if (is_object($disaster)) {
                        $total_data_count++;
                        $outputInfo .= "<tr>";
                        $outputInfo .= "<td>" . $disaster->getIncidentType() . "</td>";
                        $outputInfo .= "<td>" . $disaster->getTitle() . "</td>";
                        $outputInfo .= "<td>" . $disaster->getDeclaredCountyArea() . "</td>";
                        $outputInfo .= "<td>" . $disaster->getIncidentBeginDate() . "</td>";
                        $outputInfo .= "<td>" . $disaster->getIncidentEndDate() . "</td>";
                        $outputInfo .= "</tr>";
                    } else {
                        break;
                    }
                }
            }
            $outputInfo .= "</tbody>";
            $outputInfo .= "</table>";
            $outputInfo .= "<br><br>";
        }
    }
    $outputInfo .= "<script>jQuery('.total-data').text('" . $total_data_count . " Total Incidences');</script>";
    echo $outputInfo;
}
?>