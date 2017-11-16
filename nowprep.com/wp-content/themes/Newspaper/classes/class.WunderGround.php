<?php

require_once(__DIR__ . '/../../../../wp-load.php');

require_once(__DIR__ . '/class.WeatherForcast.php');
require_once(__DIR__ . '/class.Alerts.php');
require_once(__DIR__ . '/class.FemaDisaster.php');
require_once(__DIR__ . '/class.MySQLDB.php');
require_once(__DIR__ . '/class.DBObject.php');
require_once(__DIR__ . '/class.USGSEarthquake.php');
require_once(__DIR__ . '/class.Hurricane.php');
require_once(__DIR__ . '/class.SpotCrime.php');


class WunderGround
{
    public $dbConnect;
    public function __construct()
    {
    }

    public function getWeatherFromZipCode($zipcode)
    {
        if (preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", trim($zipcode))) {
            $json_string = file_get_contents( APISERVER . APIKEY . API_WEATHER_ENDPOINT . trim($zipcode) . APIFORMAT);

            $weather = new WeatherForcast();
            if($weather)
                $weather->initWeather($json_string);

            return $weather;
        } else {
            return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
        }
    }

    public function getWeatherFromCityState($cityState)
    {
        $loc = $this->checkForCityState($cityState);

        if (!empty($loc)) {
            $json_string = file_get_contents( APISERVER . APIKEY . API_WEATHER_ENDPOINT . $loc['state'] . "/" . $loc['city'] . APIFORMAT);

            $weather = new WeatherForcast();
            if($weather)
                $weather->initWeather($json_string);

            return $weather;
        } else {
            return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
        }
    }

    public function getWeatherFromLatLong($lat, $long)
    {
        if (is_float(floatval($lat)) and is_float(floatval($long))) {
            $json_string = file_get_contents( APISERVER . APIKEY . API_WEATHER_ENDPOINT . trim($lat) . "," . trim($long) . APIFORMAT);

            $weather = new WeatherForcast();
            if($weather)
                $weather->initWeather($json_string);

            return $weather;

        } else {
            return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
        }
    }

    function checkForCityState($cityst)
    {
        if (preg_match("/^([a-z]+),([a-z]{2})$/i", trim($cityst), $pmatch)) {
            return array(
                "city" => $pmatch[1], "state" => $pmatch[2],
            );
        }
        elseif (preg_match("/^([a-z]+),\s+([a-z]{2})$/i", trim($cityst), $pmatch)) {
            return array(
                "city" => $pmatch[1], "state" => $pmatch[2],
            );
        }
        elseif (preg_match("/^([a-z]+)\s+([a-z]{2})$/i", trim($cityst), $pmatch)) {
            return array(
                "city" => $pmatch[1], "state" => $pmatch[2],
            );
        }
    }

    public function getCountyByZip($zipcode) {
        if (preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", trim($zipcode))) {
            $json_string = file_get_contents( API_GOOGLE_ZIP . trim($zipcode) . "&key=AIzaSyAu2K7RRO_gYzm6ZorcdrTZNNWUXwDrDL0");
            $parsed_json = json_decode($json_string);
            if($parsed_json->{'status'} == "OK") {
                foreach ($parsed_json->{'results'}[0]->{'address_components'} as $address_component){
                    if(in_array('administrative_area_level_2', $address_component->{'types'})) {
                        return str_replace('County', '(County)', $address_component->{'long_name'});
                    }
                }

            } else {
                return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
            }
        } else {
            return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
        }
    }

    public function getZipByCoordinate($coordinate) {
        $json_string = file_get_contents( API_GOOGLE_ZIP_BY_COORDINATE . $coordinate[1] . "," . $coordinate[0] . "&key=AIzaSyAu2K7RRO_gYzm6ZorcdrTZNNWUXwDrDL0");
        //var_dump($json_string);
        $parsed_json = json_decode($json_string);
        $postal_code = "";
        $country = "";
        $county = "";
        if($parsed_json->{'status'} == "OK") {
            foreach ($parsed_json->{'results'}[0]->{'address_components'} as $address_component){
                if(in_array('administrative_area_level_2', $address_component->{'types'})) {
                    $county = $address_component->{'long_name'};
                    $county = trim(str_replace('County','',$county));
                }
                if(in_array('postal_code', $address_component->{'types'})) {
                    $postal_code = $address_component->{'long_name'};
                }
                if(in_array('country', $address_component->{'types'})) {
                    $country = $address_component->{'short_name'};
                }
            }
            return array("country" => $country, "county" => $county, "postal_code" => $postal_code, "address" => $parsed_json->{'results'}[0]->{'formatted_address'});
        } else {
            return null;
        }
    }


    public function getStateByZip($zipcode) {
        if (preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", trim($zipcode))) {
            $json_string = file_get_contents( API_ZIP . trim($zipcode));
            $parsed_json = json_decode($json_string);

            if($parsed_json) {
                return $parsed_json->{'places'}[0]->{'state abbreviation'};
            }
        } else {
            return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
        }
    }

    public function getAlertsFromDB() {
        $return_alerts = array();

        global $wpdb;

        if($wpdb) {
            $sqlCheckAlert = "SELECT * FROM alerts ORDER BY idalerts ASC";
            $alertRow = $wpdb->get_results($sqlCheckAlert,ARRAY_A);
            if (count($alertRow)>0) {
                foreach ( $alertRow as $row)
                {
                    $alert = new Alerts();
                    if ($alert) {
                        $alert->setRowFromDB($row);
                        array_push($return_alerts, $alert);
                    }
                }
            }
        }
        return $return_alerts;
    }

    public function getAlertsFromDBByZip($zipcode, $radius, $date_start='', $date_end='') {
        $return_alerts = array();

        global $wpdb;

        if($wpdb) {
            $sqlWHERE = $this->getSQLWHERE('zipcode', $zipcode, $radius);
            if(empty($date_start) || empty($date_end)) {
                $sqlCheckAlert = "SELECT *,FROM_UNIXTIME(expires_epoch) FROM alerts WHERE {$sqlWHERE} ORDER BY idalerts DESC";
            }
            else {
                $date_start = strtotime($date_start);
                $date_end = strtotime($date_end);
                $sqlCheckAlert = "SELECT *,FROM_UNIXTIME(expires_epoch) FROM alerts WHERE {$sqlWHERE} AND (expires_epoch BETWEEN {$date_start} AND {$date_end}) ORDER BY idalerts DESC";
            }
//var_dump($sqlCheckAlert);
            $alertRow = $wpdb->get_results($sqlCheckAlert,ARRAY_A);
            if (count($alertRow) != 0) {
                foreach ($alertRow as $row)
                {
                    $alert = new Alerts();
                    if ($alert) {
                        $alert->setRowFromDB($row);
                        array_push($return_alerts, $alert);
                    }
                }
            }
        }
        return $return_alerts;
    }


    public function getEarthquakeFromDB() {
        $return_eq = array();

        global $wpdb;

        if($wpdb) {
            $sqlCheckEQ = "SELECT *,FROM_UNIXTIME(time) AS times FROM usgsearthquake ORDER BY times DESC";
            $EQRow = $wpdb->get_results($sqlCheckEQ,ARRAY_A);
            if (count($EQRow) != 0) {
                foreach ($EQRow as $row)
                {
                    $EQ = new USGSEarthquake();
                    if ($EQ) {
                        $EQ->setRowFromDB($row);
                        array_push($return_eq, $EQ);
                    }
                }
            }
        }
        return $return_eq;
    }

    public function getEarthquakeFromDBByZip($zipcode, $radius, $date_start, $date_end) {
        $return_eq = array();

        global $wpdb;

        if($wpdb) {
            $sqlWHERE = $this->getSQLWHERE('zipcode', $zipcode, $radius);
            if(empty($date_start) || empty($date_end)) {
                $sqlCheckEQ = "SELECT *,FROM_UNIXTIME(time) AS times FROM usgsearthquake WHERE {$sqlWHERE} ORDER BY times DESC";
            } else {
                $date_start = strtotime($date_start);
                $date_end = strtotime($date_end);
                $sqlCheckEQ = "SELECT *,FROM_UNIXTIME(time) AS times FROM usgsearthquake WHERE {$sqlWHERE} AND (time BETWEEN {$date_start} AND {$date_end}) ORDER BY times DESC";
            }
            $EQRow = $wpdb->get_results($sqlCheckEQ, ARRAY_A);
            if (count($EQRow) != 0) {
                foreach ($EQRow as $row)
                {
                    $EQ = new USGSEarthquake();
                    if ($EQ) {
                        $EQ->setRowFromDB($row);
                        array_push($return_eq, $EQ);
                    }
                }
            }
        }
        return $return_eq;
    }

    public function getAlertsFromZipCode($zipcode)
    {
        if (preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", trim($zipcode))) {
            $json_string = file_get_contents( APISERVER . APIKEY . API_ALERTS_ENDPOINT . trim($zipcode) . APIFORMAT);

            $parsed_json = json_decode($json_string);
            $parsed_json_error = $parsed_json->{'response'}->{'error'};

            if($parsed_json_error) {

                return array("error" => true, "error_msg" => $parsed_json_error->{'type'} . ' : ' . $parsed_json_error->{'description'} );

            } else {

                $return_alerts = array();

                foreach ($parsed_json->{'alerts'} as $alert_json) {
                    $alert = new Alerts();
                    if ($alert) {
                        $alert->initAlerts($alert_json);
                        global $wpdb;

                        if($wpdb) {
                            $sqlCheckAlert = "SELECT idalerts, zipcode FROM alerts 
                                                WHERE typeDescription='".$alert->getTypeDescription()."' 
                                                  AND date='".$alert->getDate()."' 
                                                  AND expires = '".$alert->getExpires()."'";
                            $alertRow = $wpdb->get_results($sqlCheckAlert, ARRAY_A);
                            if (count($alertRow) == 0) {
                                $sqlInsertAlert = "INSERT INTO alerts(
                                                  type, 
                                                  typeDescription, 
                                                  description, 
                                                  date, 
                                                  date_epoch, 
                                                  expires, 
                                                  expires_epoch, 
                                                  message, 
                                                  phenomena, 
                                                  significance, 
                                                  zones, 
                                                  storm_based, 
                                                  wtype_meteoalarm, 
                                                  wtype_meteoalarm_name, 
                                                  title, 
                                                  level_meteoalarm, 
                                                  level_meteoalarm_name, 
                                                  level_meteoalarm_description, 
                                                  full_description, 
                                                  attribution, 
                                                  zipcode,
                                                  object) 
                                                  VALUES (
                                                  '".$wpdb->_real_escape($alert->getType())."',
                                                  '".$wpdb->_real_escape($alert->getTypeDescription())."',
                                                  '".$wpdb->_real_escape($alert->getDescription())."',
                                                  '".$wpdb->_real_escape($alert->getDate())."',
                                                  '".$wpdb->_real_escape($alert->getDateEpoch())."',
                                                  '".$wpdb->_real_escape($alert->getExpires())."',
                                                  '".$wpdb->_real_escape($alert->getExpiresEpoch())."',
                                                  '".$wpdb->_real_escape($alert->getMessage())."',
                                                  '".$wpdb->_real_escape($alert->getPhenomena())."',
                                                  '".$wpdb->_real_escape($alert->getSignificance())."',
                                                  '".$wpdb->_real_escape($alert->getZones())."',
                                                  '".$wpdb->_real_escape($alert->getStormBased())."',
                                                  '".$wpdb->_real_escape($alert->getWtypeMeteoalarm())."',
                                                  '".$wpdb->_real_escape($alert->getWtypeMeteoalarmName())."',
                                                  '".$wpdb->_real_escape($alert->getTitle())."',
                                                  '".$wpdb->_real_escape($alert->getLevelMeteoalarm())."',
                                                  '".$wpdb->_real_escape($alert->getLevelMeteoalarmName())."',
                                                  '".$wpdb->_real_escape($alert->getLevelMeteoalarmDescription())."',
                                                  '".$wpdb->_real_escape($alert->getFullDescription())."',
                                                  '".$wpdb->_real_escape($alert->getAttribution())."',
                                                  '".json_encode(array($zipcode))."',
                                                  '".json_encode($alert_json)."')";
                                $alertInsertRow = $wpdb->get_results($sqlInsertAlert, ARRAY_A);
                            }
                            else {
                                $idalerts = "";
                                $zipcodes = array();
                                foreach ($alertRow as $row) {
                                    $idalerts = $row['idalerts'];
                                    $zipcodes = json_decode($row['zipcode']);
                                }
                                if(!empty($idalerts)) {
                                    if(!in_array($zipcode,$zipcodes))
                                    {
                                        array_push($zipcodes, $zipcode);
                                    }
                                    $sqlUpdateAlert ="UPDATE alerts 
                                        SET type='".$wpdb->_real_escape($alert->getType())."',
                                            typeDescription='".$wpdb->_real_escape($alert->getTypeDescription())."',
                                            description='".$wpdb->_real_escape($alert->getDescription())."',
                                            date='".$wpdb->_real_escape($alert->getDate())."',
                                            date_epoch='".$wpdb->_real_escape($alert->getDateEpoch())."',
                                            expires='".$wpdb->_real_escape($alert->getExpires())."',
                                            expires_epoch='".$wpdb->_real_escape($alert->getExpiresEpoch())."',
                                            message='".$wpdb->_real_escape($alert->getMessage())."',
                                            phenomena='".$wpdb->_real_escape($alert->getPhenomena())."',
                                            significance='".$wpdb->_real_escape($alert->getSignificance())."',
                                             zones='".$wpdb->_real_escape($alert->getZones())."',
                                            storm_based='".$wpdb->_real_escape($alert->getStormBased())."',
                                            wtype_meteoalarm='".$wpdb->_real_escape($alert->getWtypeMeteoalarm())."',
                                            wtype_meteoalarm_name='".$wpdb->_real_escape($alert->getWtypeMeteoalarmName())."',
                                            title='".$wpdb->_real_escape($alert->getTitle())."',
                                            level_meteoalarm='".$wpdb->_real_escape($alert->getLevelMeteoalarm())."',
                                            level_meteoalarm_name='".$wpdb->_real_escape($alert->getLevelMeteoalarmName())."',
                                            level_meteoalarm_description='".$wpdb->_real_escape($alert->getLevelMeteoalarmDescription())."',
                                            full_description='".$wpdb->_real_escape($alert->getFullDescription())."',
                                            attribution='".$wpdb->_real_escape($alert->getAttribution())."',
                                            zipcode='".json_encode($zipcodes)."',
                                            object='".json_encode($alert_json)."'
                                            WHERE idalerts=".$idalerts;
                                    //echo "Alerts found ".$idalerts.", update \n";
                                    $alertUpdateRow = $wpdb->get_results($sqlUpdateAlert, ARRAY_A);
                                }
                            }
                            //$alertRow->free_result();
                        }
                        array_push($return_alerts, $alert);
                    }
                }

                return $return_alerts;
            }
        } else {
            return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
        }
    }

    public function getAlertsFromCityState($cityState)
    {
        $loc = $this->checkForCityState($cityState);
        if (!empty($loc)) {
            $json_string = file_get_contents( APISERVER . APIKEY . API_ALERTS_ENDPOINT . $loc['state'] . "/" . $loc['city'] . APIFORMAT);

            $parsed_json = json_decode($json_string);
            $parsed_json_error = $parsed_json->{'response'}->{'error'};

            if($parsed_json_error) {

                return array("error" => true, "error_msg" => $parsed_json_error->{'type'} . ' : ' . $parsed_json_error->{'description'} );

            } else {
                $return_alerts = array();

                foreach ($parsed_json->{'alerts'} as $alert_json) {
                    $alert = new Alerts();
                    if ($alert) {
                        $alert->initAlerts($alert_json);
                        array_push($return_alerts, $alert);
                    }
                }

                return $return_alerts;
            }
        } else {
            return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
        }
    }

    public function getAlertsFromLatLong($lat, $long)
    {
        if (is_float(floatval($lat)) and is_float(floatval($long))) {
            $json_string = file_get_contents( APISERVER . APIKEY . API_ALERTS_ENDPOINT . trim($lat) . "," . trim($long) . APIFORMAT);

            $parsed_json = json_decode($json_string);
            $parsed_json_error = $parsed_json->{'response'}->{'error'};

            if($parsed_json_error) {

                return array("error" => true, "error_msg" => $parsed_json_error->{'type'} . ' : ' . $parsed_json_error->{'description'} );

            } else {
                $return_alerts = array();

                foreach ($parsed_json->{'alerts'} as $alert_json) {
                    $alert = new Alerts();
                    if ($alert) {
                        $alert->initAlerts($alert_json);
                        array_push($return_alerts, $alert);
                    }
                }

                return $return_alerts;
            }

        } else {
            return array("error" => true, "error_msg" => "No location found. Only valid US zipcodes or city, state format supported currently");
        }
    }

    public function getDisastersFromState($state,$zipcode)
    {
        $return_disasters = array();
        $return_disaster_numbers = array();
        if (!empty($state)) {
            $json_string = file_get_contents(API_FEMA_ENDPOINT_STATE_FILTER . "'" . trim($state) . "'");

            $parsed_json = json_decode($json_string);

            global $wpdb;

            foreach ($parsed_json->{'DisasterDeclarationsSummaries'} as $disaster_json) {
                $disaster = null;
                $disaster = new FemaDisaster();
                if ($disaster) {
                    $disaster->initFemaDisaster($disaster_json);
                    //if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers))
                    {
                        if ($wpdb) {
                            $sqlCheckDisaster = "SELECT idfema,placeCode FROM fema WHERE disasterNumber='" . $disaster->getDisasterNumber() . "'";
                            $disasterRow = $wpdb->get_results($sqlCheckDisaster, ARRAY_A);
                            if (count($disasterRow)==0) {
                                //echo "DisasterNumber = " . $disaster->getDisasterNumber() . " not found, insert \n";
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
                                                  '" . json_encode(array($zipcode)) . "',
                                                  '" . json_encode($disaster_json) . "'
                                                  )";
                                //var_dump($sqlInsertDisaster);
                                $disasterInsertRow = $wpdb->get_results($sqlInsertDisaster, ARRAY_A);
                            } else {
                                $idfema = "";
                                $zipcodes = array();
                                foreach ($disasterRow as $row) {
                                    $idfema = $row['idfema'];
                                    $zipcodes = json_decode($row['placeCode']);
                                }
                                if(is_array($zipcodes)) {
                                    if (!in_array($zipcode, $zipcodes)) {
                                        array_push($zipcodes, $zipcode);
                                    }
                                    $sqlUpdateDisaster ="UPDATE fema 
                                        SET placeCode = '".$wpdb->_real_escape($disaster->getPlaceCode())."',
                                            zipcodes ='".json_encode($zipcodes)."',
                                            object = '".json_encode($disaster_json)."'
                                            WHERE idfema=".$idfema;
                                    //echo "DisasterNumber = " . $disaster->getDisasterNumber() . " found DBID = ".$idfema.", update\n";
                                    $disasterUpdateRow = $wpdb->get_results($sqlUpdateDisaster, ARRAY_A);
                                }
                            }
                        }
                    }
                    if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers)) {
                        array_push($return_disaster_numbers, $disaster->getDisasterNumber());
                        array_push($return_disasters, $disaster);
                    }
                    //$disasterRow->free_result();
                }
                $disaster_json = null;
            }

        }
        return $return_disasters;
    }

    public function getDisastersFromFileByState($state,$zipcode,$file)
    {
        $return_disasters = array();
        $return_disaster_numbers = array();
        if (!empty($state)) {
            $json_string = file_get_contents($file);

            global $wpdb;

            $parsed_json = json_decode($json_string);
            //var_dump($parsed_json);die();
            foreach ($parsed_json->{'DisasterDeclarationsSummaries'} as $disaster_json) {
                $disaster = null;
                $disaster = new FemaDisaster();
                if ($disaster) {
                    $zipcodes = array();
                    $disaster->initFemaDisaster($disaster_json);
                    echo "==================================================\n";
                    echo "State = " . $disaster->getState() . " County = ".trim(str_replace('(County)','',$disaster->getDeclaredCountyArea())). " not found, insert \n";
                    $sqlGetZipsList = "SELECT postal_code FROM zips 
                                        WHERE state_code='" . $disaster->getState() . "' 
                                          AND county_name LIKE '".trim(str_replace('(County)','',$disaster->getDeclaredCountyArea()))."%'";
                    $ZipsList = $wpdb->get_results($sqlGetZipsList, ARRAY_A);
                    if (count($ZipsList) == 0) {
                        foreach ($ZipsList as $row) {
                            array_push($zipcodes,$row['postal_code']);
                        }
                    }
                    //if($disaster->getState() != $state) continue;
                    //if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers))
                    {
                        if ($wpdb) {
                            $sqlCheckDisaster = "SELECT idfema,placeCode FROM fema WHERE disasterNumber='" . $disaster->getDisasterNumber() . "'";
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
                                //while ($row = $disasterRow->fetch_assoc()) {
                                //    $idfema = $row['idfema'];
                                //    $zipcodes = json_decode($row['zipcodes']);
                                //}
                                if(is_array($zipcodes)) {
                                    //if (!in_array($zipcode, $zipcodes)) {
                                    //    array_push($zipcodes, $zipcode);
                                    //}
                                    $sqlUpdateDisaster ="UPDATE fema 
                                        SET placeCode = '".$wpdb->_real_escape($disaster->getPlaceCode())."',
                                            zipcodes ='".json_encode($zipcodes)."',
                                            object = '".json_encode($disaster_json)."'
                                            WHERE idfema=".$idfema;
                                    echo "DisasterNumber = " . $disaster->getDisasterNumber() . " found DBID = ".$idfema.", update\n";
                                    $disasterUpdateRow = $wpdb->get_results($sqlUpdateDisaster, ARRAY_A);
                                }
                            }
                        }
                    }
                    if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers)) {
                        array_push($return_disaster_numbers, $disaster->getDisasterNumber());
                        array_push($return_disasters, $disaster);
                    }
                    //$disasterRow->free_result();
                }
                $disaster_json = null;
            }

        }
        return $return_disasters;
    }

    public function getDisastersHistoryFromState($state,$zipcode)
    {
        global $wpdb;

        $return_disasters = array();
        $return_disaster_numbers = array();
        if (!empty($state)) {
            $json_string = file_get_contents(API_FEMA_ENDPOINT_STATE_H_FILTER . "'" . trim($state) . "'");

            $parsed_json = json_decode($json_string);

            foreach ($parsed_json->{'DisasterDeclarationsSummaries'} as $disaster_json) {
                $disaster = null;
                $disaster = new FemaDisaster();
                if ($disaster) {
                    $disaster->initFemaDisaster($disaster_json);
                    //if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers))
                    {
                        if ($wpdb) {
                            $sqlCheckDisaster = "SELECT idfema,placeCode FROM fema WHERE disasterNumber='" . $disaster->getDisasterNumber() . "'";
                            $disasterRow = $wpdb->get_results($sqlCheckDisaster, ARRAY_A);
                            if (count($disasterRow) == 0) {
                                //echo "DisasterNumber = " . $disaster->getDisasterNumber() . " not found, insert \n";
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
                                                      id) 
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
                                                  '" . json_encode(array($zipcode)) . "',
                                                  '" . $wpdb->_real_escape($disaster->getDeclaredCountyArea()) . "',
                                                  '" . $wpdb->_real_escape($disaster->getLastRefresh()) . "',
                                                  '" . $wpdb->_real_escape($disaster->getHash()) . "',
                                                  '" . $wpdb->_real_escape($disaster->getId()) . "')";
                                //var_dump($sqlInsertDisaster);
                                $disasterInsertRow = $wpdb->get_results($sqlInsertDisaster, ARRAY_A);
                            } else {
                                $idfema = "";
                                $zipcodes = array();
                                foreach ($disasterRow as $row) {
                                    $idfema = $row['idfema'];
                                    $zipcodes = json_decode($row['placeCode']);
                                }
                                if(is_array($zipcodes)) {
                                    if (!in_array($zipcode, $zipcodes)) {
                                        array_push($zipcodes, $zipcode);
                                    }
                                    $sqlUpdateDisaster ="UPDATE fema 
                                        SET placeCode='".json_encode($zipcodes)."' 
                                            WHERE idfema=".$idfema;
                                    //echo "DisasterNumber = " . $disaster->getDisasterNumber() . " found DBID = ".$idfema.", update\n";
                                    $disasterUpdateRow = $wpdb->get_results($sqlUpdateDisaster,ARRAY_A);
                                }
                            }
                        }
                    }
                    if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers)) {
                        array_push($return_disaster_numbers, $disaster->getDisasterNumber());
                        array_push($return_disasters, $disaster);
                    }
                    //$disasterRow->free_result();
                }
                $disaster_json = null;
            }

        }
        return $return_disasters;
    }

    public function getDisasterTypesByZip($zipcode)
    {
        $return_disasters = array();

        global $wpdb;

        if ($wpdb) {
            $sqlCheckDisaster = "SELECT DISTINCT incidentType FROM fema WHERE zipcodes LIKE '%".$zipcode."%'";
            $disasterRow = $wpdb->get_results($sqlCheckDisaster, ARRAY_A);
            if (count($disasterRow) != 0) {
                foreach ($disasterRow as $row) {
                    array_push($return_disasters, $row['incidentType']);
                }
            }
        }

        return $return_disasters;
    }

    public function getDisastersByType($type, $zipcode, $radius, $date_start='', $date_end='')
    {
        $return_disasters = array();
		global $wpdb;
        if ($wpdb) {
            $sqlWHERE = $this->getSQLWHERE('zipcodes', $zipcode, $radius);
            if(empty($date_start) || empty($date_end))
            {
                $sqlCheckDisaster = "SELECT idfema, type, disasterNumber, state, declarationDate, disasterType, incidentType, 
                                            title, STR_TO_DATE(incidentBeginDate,'%Y-%m-%d') as incidentBeginDate, 
                                            STR_TO_DATE(incidentEndDate,'%Y-%m-%d') as incidentEndDate, disasterCloseOutDate, 
                                            placeCode, declaredCountyArea, lastRefresh, hash, id, zipcodes, object 
                                        FROM fema 
                                        WHERE incidentType='" . $type . "' 
                                          AND {$sqlWHERE} 
                                        ORDER BY incidentBeginDate DESC";
            } else {
                $sqlCheckDisaster = "SELECT idfema, type, disasterNumber, state, declarationDate, disasterType, incidentType, 
                                            title, STR_TO_DATE(incidentBeginDate,'%Y-%m-%d') as incidentBeginDate, 
                                            STR_TO_DATE(incidentEndDate,'%Y-%m-%d') as incidentEndDate, disasterCloseOutDate, 
                                            placeCode, declaredCountyArea, lastRefresh, hash, id, zipcodes, object 
                                        FROM fema 
                                        WHERE incidentType='" . $type . "' 
                                          AND {$sqlWHERE} 
                                          AND (UNIX_TIMESTAMP(STR_TO_DATE(incidentBeginDate,'%Y-%m-%d')) 
                                                BETWEEN UNIX_TIMESTAMP(STR_TO_DATE('{$date_start}','%m/%d/%Y')) 
                                                AND UNIX_TIMESTAMP(STR_TO_DATE('{$date_end}','%m/%d/%Y'))) 
                                        ORDER BY incidentBeginDate DESC";

            }
            $disasterRow = $wpdb->get_results($sqlCheckDisaster, ARRAY_A);
            if (count($disasterRow) != 0) {
                foreach ($disasterRow as $row) {
                    $disaster = new FemaDisaster();
                    $disaster->setRowFromDB($row);
                    array_push($return_disasters, $disaster);
                }
            }
        }

        return $return_disasters;
    }

    public function getDisastersFromCounty($county, $zipcode)
    {
        global $wpdb;
        $return_disasters = array();
        $return_disaster_numbers = array();
        if (!empty($county)) {
            $json_string = file_get_contents(API_FEMA_ENDPOINT_COUNTY_FILTER . "'" . trim(str_replace(' ','%20',$county)) . "'");

            $parsed_json = json_decode($json_string);

            foreach ($parsed_json->{'DisasterDeclarationsSummaries'} as $disaster_json) {
                $disaster = new FemaDisaster();
                if ($disaster) {
                    $disaster->initFemaDisaster($disaster_json);
                    //if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers))
                    {
                        if ($wpdb) {
                            $sqlCheckDisaster = "SELECT idfema,placeCode FROM fema WHERE disasterNumber='" . $disaster->getDisasterNumber() . "'";
                            $disasterRow = $wpdb->get_results($sqlCheckDisaster, ARRAY_A);
                            if (count($disasterRow) == 0) {
                                //echo "DisasterNumber = " . $disaster->getDisasterNumber() . " not found, insert \n";
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
                                                      id) 
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
                                                  '" . json_encode(array($zipcode)) . "',
                                                  '" . $wpdb->_real_escape($disaster->getDeclaredCountyArea()) . "',
                                                  '" . $wpdb->_real_escape($disaster->getLastRefresh()) . "',
                                                  '" . $wpdb->_real_escape($disaster->getHash()) . "',
                                                  '" . $wpdb->_real_escape($disaster->getId()) . "')";
                                //var_dump($sqlInsertDisaster);
                                $disasterInsertRow = $wpdb->get_results($sqlInsertDisaster, ARRAY_A);
                            } else {
                                $idfema = "";
                                $zipcodes = array();
                                foreach ($disasterRow as $row) {
                                    $idfema = $row['idfema'];
                                    $zipcodes = json_decode($row['placeCode']);
                                }

                                if(is_array($zipcodes)) {
                                    if (!in_array($zipcode, $zipcodes)) {
                                        array_push($zipcodes, $zipcode);
                                    }
                                    $sqlUpdateDisaster ="UPDATE fema 
                                        SET placeCode='".json_encode($zipcodes)."' 
                                            WHERE idfema=".$idfema;
                                    //var_dump($sqlUpdateDisaster);
                                    //echo "DisasterNumber = " . $disaster->getDisasterNumber() . " found, update\n";
                                    $disasterUpdateRow = $wpdb->get_results($sqlUpdateDisaster, ARRAY_A);
                                }
                            }
                        }
                    }
                    if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers)) {
                        array_push($return_disaster_numbers, $disaster->getDisasterNumber());
                        array_push($return_disasters, $disaster);
                    }
                    //$disasterRow->free_result();
                }
            }

        }
        return $return_disasters;
    }

    public function getUSGSHistoryData()
    {
        global $wpdb;
        $return_eq = array();
        $json_string = file_get_contents(API_USGS_ENDPOINT_EARTHQUAKE_HISTORY);

        $parsed_json = json_decode($json_string);
        $iCount = count($parsed_json->{'features'});
        foreach ($parsed_json->{'features'} as $index=>$earthquake_json) {
            $earthquake = new USGSEarthquake();
            if ($earthquake) {
                $earthquake->initEarthquake($earthquake_json);
                echo "============================================\n";
                echo "#" . $index . " of " . $iCount ."\n";
                echo "ID: ".$earthquake->getId()."\n";
                echo "Title: ".$earthquake->getTitle()."\n";
                if ($wpdb) {
                    $sqlEQCheck = "SELECT id FROM usgsearthquake WHERE id='" . $earthquake->getId() . "'";
                    $EQCheckRow = $wpdb->get_results($sqlEQCheck,ARRAY_A);
                    if (count($EQCheckRow) == 0) {
                        $zipcode = $this->getZipByCoordinate($earthquake->getCoordinates());
                        $zipcodes = array();
                        if (is_array($zipcode)) {
                            if(empty($zipcode['postal_code'])) {
                                if(!empty($zipcode['county'])) {
                                    $sqlGetZips = "SELECT postal_code FROM zips WHERE county_name LIKE '" . $zipcode['county'] . "%'";
                                    $ZipsRow = $wpdb->get_results($sqlGetZips, ARRAY_A);
                                    if (count($ZipsRow) != 0) {
                                        foreach ($ZipsRow as $row) {
                                            array_push($zipcodes, $row['postal_code']);
                                        }
                                    }
                                }
                            } else {
                                array_push($zipcodes, $zipcode['postal_code']);
                            }

                            echo "Country: " . $zipcode['country'] . "\n";
                            echo "County: " . $zipcode['county'] . "\n";
                            echo "Zipcode: " . join(',',$zipcodes) . "\n";
                            $sqlInsertEQ = "INSERT INTO usgsearthquake(
                                  id, 
                                  title, 
                                  type, 
                                  magType, 
                                  gap, 
                                  rms, 
                                  dmin, 
                                  nst, 
                                  types, 
                                  sources, 
                                  ids, 
                                  code, 
                                  net, 
                                  sig, 
                                  tsunami, 
                                  status, 
                                  alert, 
                                  mmi, 
                                  cdi, 
                                  felt, 
                                  detail, 
                                  url, 
                                  tz, 
                                  updated, 
                                  time, 
                                  place, 
                                  mag, 
                                  coordinates,
                                  zipcode,
                                  country,
                                  address) 
                                  VALUES (
                                  '" . $wpdb->_real_escape($earthquake->getId()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getTitle()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getType()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getMagType()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getGap()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getRms()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getDmin()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getNst()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getTypes()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getSources()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getIds()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getCode()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getNet()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getSig()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getTsunami()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getStatus()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getAlert()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getMmi()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getCdi()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getFelt()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getDetail()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getUrl()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getTz()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getUpdated()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getTime()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getPlace()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getMag()) . "',
                                  '" . json_encode($earthquake->getCoordinates()) . "',
                                  '" . json_encode($zipcodes) . "',
                                  '" . $zipcode['country'] . "',
                                  '" . $zipcode['address'] . "'                                
                                  )";
                            $EQInsertRow = $wpdb->get_results($sqlInsertEQ,ARRAY_A);
                            array_push($return_eq,$earthquake);
                        }
                    }
                }
                echo "============================================\n";
            }
        }
        return $return_eq;
    }

    public function getUSGSData($date_start, $date_end)
    {
        global $wpdb;
        $return_eq = array();
        //var_dump(API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$date_start."&endtime=".$date_end);die();
        $json_string = file_get_contents(API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$date_start."&endtime=".$date_end);


        $parsed_json = json_decode($json_string);
        $iCount = count($parsed_json->{'features'});
        foreach ($parsed_json->{'features'} as $index=>$earthquake_json) {
            $earthquake = new USGSEarthquake();
            if ($earthquake) {
                $earthquake->initEarthquake($earthquake_json);
                echo "============================================\n";
                echo "#" . ($index + 1). " of " . $iCount ."\n";
                echo "ID: ".$earthquake->getId()."\n";
                echo "Title: ".$earthquake->getTitle()."\n";
                if ($wpdb) {
                    $sqlEQCheck = "SELECT id FROM usgsearthquake WHERE id='" . $earthquake->getId() . "'";
                    $EQCheckRow = $wpdb->get_results($sqlEQCheck,ARRAY_A);
                    if (count($EQCheckRow) == 0) {
                        $zipcode = $this->getZipByCoordinate($earthquake->getCoordinates());
                        $zipcodes = array();
                        if (is_array($zipcode)) {
                            if(empty($zipcode['postal_code'])) {
                                if(!empty($zipcode['county'])) {
                                    $sqlGetZips = "SELECT postal_code FROM zips WHERE county_name LIKE '" . $zipcode['county'] . "%'";
                                    $ZipsRow = $wpdb->get_results($sqlGetZips,ARRAY_A);
                                    if (count($ZipsRow) != 0) {
                                        foreach ($ZipsRow as $row) {
                                            array_push($zipcodes, $row['postal_code']);
                                        }
                                    }
                                }
                            } else {
                                array_push($zipcodes, $zipcode['postal_code']);
                            }

                            echo "Country: " . $zipcode['country'] . "\n";
                            echo "County: " . $zipcode['county'] . "\n";
                            echo "Zipcode: " . join(',',$zipcodes) . "\n";

                            $sqlInsertEQ = "INSERT INTO usgsearthquake(
                                  id, 
                                  title, 
                                  type, 
                                  magType, 
                                  gap, 
                                  rms, 
                                  dmin, 
                                  nst, 
                                  types, 
                                  sources, 
                                  ids, 
                                  code, 
                                  net, 
                                  sig, 
                                  tsunami, 
                                  status, 
                                  alert, 
                                  mmi, 
                                  cdi, 
                                  felt, 
                                  detail, 
                                  url, 
                                  tz, 
                                  updated, 
                                  time, 
                                  place, 
                                  mag, 
                                  coordinates,
                                  zipcode,
                                  country,
                                  address,
                                  object) 
                                  VALUES (
                                  '" . $wpdb->_real_escape($earthquake->getId()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getTitle()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getType()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getMagType()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getGap()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getRms()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getDmin()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getNst()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getTypes()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getSources()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getIds()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getCode()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getNet()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getSig()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getTsunami()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getStatus()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getAlert()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getMmi()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getCdi()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getFelt()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getDetail()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getUrl()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getTz()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getUpdated()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getTime()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getPlace()) . "',
                                  '" . $wpdb->_real_escape($earthquake->getMag()) . "',
                                  '" . json_encode($earthquake->getCoordinates()) . "',
                                  '" . json_encode($zipcodes) . "',
                                  '" . $zipcode['country'] . "',
                                  '" . $zipcode['address'] . "',
                                  '" . json_encode($earthquake_json) . "'                                                                  
                                  )";
                            $EQInsertRow = $wpdb->get_results($sqlInsertEQ,ARRAY_A);
                            array_push($return_eq,$earthquake);
                        }
                    }
                }
                echo "============================================\n";
            }
        }
        return $return_eq;
    }

    public function getCurrentHurricanes()
    {
        global $wpdb;
        $json_string = file_get_contents( APISERVER . APIKEY . API_CURRENT_HURRICANE_ENDPOINT . APIFORMAT);

        $parsed_json = json_decode($json_string);

        $return_hurricane = array();

        //Update all records, set to inactive
        if ($wpdb) {
            $sqlUpdate = "UPDATE hurricane SET active_flag = 0";
            $updateRow = $wpdb->get_results($sqlUpdate,ARRAY_A);
        }

        foreach ($parsed_json->{'currenthurricane'} as $currenthurricane_json) {
            $currenthurricane = new Hurricanes();
            if ($currenthurricane) {
                $currenthurricane->initHurricane($currenthurricane_json);
                echo "============================================\n";
                echo "Number: ".$currenthurricane->getStormNumber()."\n";
                echo "Name: ".$currenthurricane->getStormName()."\n";

                if ($wpdb) {
                    $sqlCheck = "SELECT stormNumber FROM hurricane WHERE stormNumber='" . $currenthurricane->getStormNumber() . "'";
                    $checkRow = $wpdb->get_results($sqlCheck, ARRAY_A);
                    if (count($checkRow) == 0) {
                        $sqlInsert = "INSERT INTO hurricane (stormNumber, stormName, zipcode, object, active_flag) VALUES (
                                      '".$currenthurricane->getStormNumber()."',
                                      '".$currenthurricane->getStormName()."',
                                      '".json_encode($currenthurricane->getZipcodes())."',
                                      '".json_encode($currenthurricane->getObject())."',
                                      1
                                      )";
                        $insertRow = $wpdb->get_results($sqlInsert, ARRAY_A);
                        echo "DATA INSERTED\n";
                    } else {
                        $sqlUpdate = "UPDATE hurricane 
                                        SET object = '".json_encode($currenthurricane->getObject())."',
                                            active_flag = 1
                                        WHERE stormNumber = '".$currenthurricane->getStormNumber()."'";
                        $updateRow = $wpdb->get_results($sqlUpdate, ARRAY_A);
                        echo "DATA UPDATED\n";
                    }
                    array_push($return_hurricane, $currenthurricane);
                }
                echo "============================================\n";
            }
        }

        return $return_hurricane;
    }

    public function getHurricanesFromDB() {
        global $wpdb;
        $return_hurricane = array();

        if($wpdb) {
            $sqlSelect = "SELECT * FROM hurricane ORDER BY active_flag, id ASC";
            $selectRow = $wpdb->get_results($sqlSelect, ARRAY_A);
            if (count($selectRow) != 0) {
                foreach ($selectRow as $row)
                {
                    $hurricane = new Hurricanes();
                    if ($hurricane) {
                        $hurricane->setRowFromDB($row);
                        array_push($return_hurricane, $hurricane);
                    }
                }
            }
        }
        return $return_hurricane;
    }

    public function getCrimes($zipcode,$lat,$lon) {
        $return_crimes = array();

        $json_string = RestCurl::get(API_SPOTCRIME_ENDPOINT_REALTIME,array('lat'=>$lat,'lon'=>$lon,'radius'=>5,'key'=>API_SPOTCRIME_KEY));

        //var_dump($json_string);die();

        $parsed_json = json_decode($json_string);
        //var_dump($parsed_json);die();
        $iCount = count($parsed_json->{'crimes'});

        global $wpdb;

        foreach ($parsed_json->{'crimes'} as $index => $crime) {
            $crimes = new SpotCrimes();
            if ($crimes) {
                $crimes->initCrimes($crime);
                echo "============================================\n";
                echo "#" . ($index + 1) . " of " . $iCount . "\n";
                echo "ID: " . $crimes->getCdid() . "\n";
                echo "Type: " . $crimes->getType() . "\n";
                if ($wpdb) {
                    $sqlCheck = "SELECT cdid,zipcodes FROM SpotCrimes WHERE cdid='" . $crimes->getCdid() . "'";
                    $checkRow = $wpdb->get_results($sqlCheck, ARRAY_A);
                    if (count($checkRow) == 0) {
                        echo "CrimeID = " . $crimes->getCdid() . " not found, insert \n";
                        $insertSQL = "INSERT INTO SpotCrimes(cdid, type, date, address, link, lat, lon, zipcodes, object) 
                                      VALUES (
                                      '".$wpdb->_real_escape($crimes->getCdid())."',
                                      '".$wpdb->_real_escape($crimes->getType())."',
                                      '".$wpdb->_real_escape($crimes->getDate())."',
                                      '".$wpdb->_real_escape($crimes->getAddress())."',
                                      '".$wpdb->_real_escape($crimes->getLink())."',
                                      '".$wpdb->_real_escape($crimes->getLat())."',
                                      '".$wpdb->_real_escape($crimes->getLon())."',
                                      '".json_encode(array($zipcode))."',
                                      '".json_encode($crime)."'
                                      )";
                        $insertRow = $wpdb->get_results($insertSQL, ARRAY_A);
                    } else {
                        echo "CrimeID = " . $crimes->getCdid() . " found, update \n";
                        $zipcodes = array();
                        foreach ($checkRow as $row) {
                            $zipcodes = json_decode($row['zipcodes']);
                        }
                        if(is_array($zipcodes))
                        {
                            if(!in_array($zipcode, $zipcodes))
                            {
                                array_push($zipcodes,$zipcode);
                            }
                        } else $zipcodes = array($zipcode);

                        $updateSQL = "UPDATE SpotCrimes SET 
                                      zipcodes='".json_encode(array($zipcode))."',
                                      object='".json_encode($crime)."' 
                                      WHERE cdid='".$crimes->getCdid()."'";
                        $updateRow = $wpdb->get_results($updateSQL, ARRAY_A);
                    }
                    array_push($return_crimes, $crimes);
                }
            }
        }

        return $return_crimes;
    }

    public function getZipsByRadius($zipcode, $radius)
    {
        $zipcodes_list = array();

        global $wpdb;

        if($wpdb)
        {
            $sqlGetZips = sprintf("SELECT FIELD10,FIELD11 FROM zips WHERE postal_code='%s'", $zipcode);
            $zipcodes = $wpdb->get_results($sqlGetZips,ARRAY_A);

            $longitude = false;
            $latitude = false;
            if (count($zipcodes) != 0) {
                foreach ($zipcodes as $row) {
                    $longitude = $row['FIELD11'];
                    $latitude = $row['FIELD10'];
                }
            }
            if($longitude && $latitude) {
                $sqlGetZips = "SELECT postal_code FROM zips 
                                WHERE (FIELD11 BETWEEN ({$longitude} - {$radius}/abs(cos(radians({$latitude}))*69)) 
                                  AND ({$longitude} + {$radius}/abs(cos(radians({$latitude}))*69))) 
                                  AND (FIELD10 BETWEEN ({$latitude} - ({$radius}/69)) 
                                  AND ({$latitude} + ({$radius}/69)))";
                var_dump($sqlGetZips);
                $zipcodes = $wpdb->get_results($sqlGetZips,ARRAY_A);
                foreach ($zipcodes as $row) {
                    array_push($zipcodes_list, $row['postal_code']);
                }
            }

        }
        return $zipcodes_list;
    }

    public function getInfoByZip($zipcode)
    {
        $zipcodes_list = array();
        global $wpdb;
        if($wpdb)
        {
            $sqlGetZips = sprintf("SELECT * FROM zips WHERE postal_code='%s'", $zipcode);
            $zipcodes = $wpdb->get_results($sqlGetZips, ARRAY_A);
            if (count($zipcodes) != 0) {
                foreach ($zipcodes as $row) {
                    return $row;
                }
            }
        }
        return $zipcodes_list;
    }

    public function getCoordByZip($zipcode)
    {
        $zipcodes_list = array();

        global $wpdb;

        if($wpdb)
        {
            $sqlGetZips = sprintf("SELECT FIELD10,FIELD11 FROM zips WHERE postal_code='%s'", $zipcode);
            $zipcodes = $wpdb->get_results($sqlGetZips, ARRAY_A);
            $longitude = false;
            $latitude = false;
            if (count($zipcodes) != 0) {
                foreach ($zipcodes as $row) {
                    $longitude = $row['FIELD11'];
                    $latitude = $row['FIELD10'];
                }
            }
            return array('longitude' => $longitude, 'latitude' => $latitude);
        }
        return $zipcodes_list;
    }


    public function getSQLWHERE($field_name, $zipcode, $radius)
    {
        $zipcodes_list = $this->getZipsByRadius($zipcode,$radius);
        $sqlWHERE = "";
        foreach ($zipcodes_list as $index => $zip)
        {
            if($index == (count($zipcodes_list)-1))
                $sqlWHERE .= "({$field_name} LIKE '%{$zip}%')";
            else
                $sqlWHERE .= "({$field_name} LIKE '%{$zip}%') OR ";
        }
        if(!empty($sqlWHERE))
            $sqlWHERE = "({$sqlWHERE})";

        return $sqlWHERE;
    }

    public function getZipsByСoord($latitude, $longitude , $radius)
    {
        global $wpdb;
        $zipcodes_list = array();
        if($wpdb)
        {
            if($longitude && $latitude) {
                $sqlGetZips = "SELECT postal_code FROM zips 
                                WHERE (FIELD11 BETWEEN ({$longitude} - {$radius}/abs(cos(radians({$latitude}))*69)) 
                                  AND ({$longitude} + {$radius}/abs(cos(radians({$latitude}))*69))) 
                                  AND (FIELD10 BETWEEN ({$latitude} - ({$radius}/69)) 
                                  AND ({$latitude} + ({$radius}/69)))";
                $zipcodes = $wpdb->get_results($sqlGetZips, ARRAY_A);
                foreach ($zipcodes as $row) {
                    array_push($zipcodes_list, $row['postal_code']);
                }
            }

        }
        return $zipcodes_list;
    }
}