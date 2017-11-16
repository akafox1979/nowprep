<?php

require_once('config/config.php');
require_once('classes/class.WunderGround.php');
ini_set('memory_limit', '512M');
global $wpdb;

$return_disasters = array();
$return_disaster_numbers = array();
$wunderground = new WunderGround();
if ($wpdb) {
    $date = date("Y-m-d");
    $mod_date = strtotime($date . "- 1 days");
    $json_string = file_get_contents(API_FEMA_ENDPOINT_WITHOUT_FILTER . "'" . date("Y-m-d", $mod_date) . "T00:00:00.000z'");
    //$json_string = file_get_contents("https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries.json");
    //$json_string = "[" . str_replace("}{", "},{", $json_string) . "]";
    $parsed_json = json_decode($json_string);
    $iCountAll = count($parsed_json);
    $iCount = 0;
    foreach ($parsed_json as $disaster_json) {
        $disaster = null;
        $disaster = new FemaDisaster();
        if ($disaster) {
            $zipcodes = array();
            $disaster->initFemaDisaster($disaster_json);
            $iCount++;
            echo "==================================================\n";
            echo "Item : " . $iCount . " of " . $iCountAll . "\n";
            echo "State = " . $disaster->getState() . " County = " . trim(str_replace('(County)', '', $disaster->getDeclaredCountyArea())) . "\n";
            $county_names = $wpdb->_real_escape(trim(str_replace('(County)', '', $disaster->getDeclaredCountyArea())));
            $county_names = $wpdb->_real_escape(trim(str_replace('(Parish)', 'Parish', $county_names)));
            $county_names = $wpdb->_real_escape(trim(str_replace('(Borough)', 'Borough', $county_names)));

            $sqlGetZipsList = "SELECT postal_code FROM zips WHERE state_code='" . $disaster->getState() . "' AND county_name LIKE '" . $county_names . "%'";
            $ZipsList = $wpdb->get_results($sqlGetZipsList, ARRAY_A);
            if (count($ZipsList) != 0) {
                foreach ($ZipsList as $row) {
                    array_push($zipcodes, $row['postal_code']);
                }
            }
//echo "ZIP Codes for county = " . join(',',$zipcodes). "\n";
//if($disaster->getState() != $state) continue;
//if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers))
            {
                if ($wpdb) {
                    $sqlCheckDisaster = "SELECT id,zipcodes FROM fema WHERE id='" . $disaster->getId() . "'";
                    $disasterRow = $wpdb->get_results($sqlCheckDisaster, ARRAY_A);
                    if (count($disasterRow) == 0) {
                        echo "DisasterNumber = " . $disaster->getDisasterNumber() . " not found, insert \n";
                        $sqlInsertDisaster = "INSERT INTO fema(
                                                    type,
                                                    disasterNumber,
                                                    state,
                                                    declarationDate,
                                                    disasterType,
                                                    incidentType,
                                                    title,
                                                    incidentBeginDate,
                                                    incidentEndDate,
                                                    disasterCloseOutDate,
                                                    placeCode,
                                                    declaredCountyArea,
                                                    lastRefresh,
                                                    hash,
                                                    id,
                                                    zipcodes,
                                                    object)
                                                    VALUES (
                                                    '" . $wpdb->_real_escape($disaster->getType()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getDisasterNumber()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getState()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getDeclarationDate()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getDisasterType()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getIncidentType()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getTitle()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getIncidentBeginDate()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getIncidentEndDate()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getDisasterCloseOutDate()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getPlaceCode()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getDeclaredCountyArea()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getLastRefresh()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getHash()) . "',
                                                    '" . $wpdb->_real_escape($disaster->getId()) . "',
                                                    '" . json_encode($zipcodes) . "',
                                                    '" . json_encode($disaster_json) . "'
                                                    )";
//var_dump($sqlInsertDisaster);
                        $disasterInsertRow = $wpdb->get_results($sqlInsertDisaster, ARRAY_A);
                    } else {
                        $idfema = "";
                        foreach ($disasterRow as $row) {
                            $idfema = $row['id'];
                            $zipcodes1 = json_decode($row['zipcodes']);
                            if (is_array($zipcodes1)) {
                                foreach ($zipcodes1 as $zip1) {
                                    if (!in_array($zip1, $zipcodes)) {
                                        array_push($zipcodes, $zip1);
                                    }
                                }
                            }
                        }
                        if (is_array($zipcodes)) {
//if (!in_array($zipcode, $zipcodes)) {
//    array_push($zipcodes, $zipcode);
//}
                            $sqlUpdateDisaster = "UPDATE fema
SET placeCode = '" . $wpdb->_real_escape($disaster->getPlaceCode()) . "',
zipcodes ='" . json_encode($zipcodes) . "',
object = '" . json_encode($disaster_json) . "'
WHERE id='" . $idfema . "'";
                            echo "DisasterNumber = " . $disaster->getDisasterNumber() . " found DBID = " . $idfema . ", update\n";
                            $disasterUpdateRow = $wpdb->get_results($sqlUpdateDisaster, ARRAY_A);
                        }
                    }
                }
            }
            if (!in_array($disaster->getDisasterNumber(), $return_disaster_numbers)) {
                array_push($return_disaster_numbers, $disaster->getDisasterNumber());
                array_push($return_disasters, $disaster);
            }
//$disasterRow->free_result();
        }
        $disaster_json = null;
    }

}