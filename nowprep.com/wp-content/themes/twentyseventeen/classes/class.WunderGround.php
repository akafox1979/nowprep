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

        if($this->dbConnect) {
            $sqlCheckAlert = "SELECT * FROM alerts ORDER BY idalerts ASC";
            $alertRow = mysqli_query($this->dbConnect, $sqlCheckAlert);
            if ($alertRow->num_rows != 0) {
                while ($row = $alertRow->fetch_assoc())
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

        if($this->dbConnect) {
            $sqlCheckEQ = "SELECT *,FROM_UNIXTIME(time) AS times FROM USGSEarthquake ORDER BY times DESC";
            $EQRow = mysqli_query($this->dbConnect, $sqlCheckEQ);
            if ($EQRow->num_rows != 0) {
                while ($row = $EQRow->fetch_assoc())
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
                $sqlCheckEQ = "SELECT *,FROM_UNIXTIME(time) AS times FROM USGSEarthquake WHERE {$sqlWHERE} ORDER BY times DESC";
            } else {
                $date_start = strtotime($date_start);
                $date_end = strtotime($date_end);
                $sqlCheckEQ = "SELECT *,FROM_UNIXTIME(time) AS times FROM USGSEarthquake WHERE {$sqlWHERE} AND (time BETWEEN {$date_start} AND {$date_end}) ORDER BY times DESC";
            }
//var_dump($sqlCheckEQ);die();
//$wpdb->show_errors( true );
            $EQRow = $wpdb->get_results($sqlCheckEQ, ARRAY_A);
            //$wpdb->query()
//var_dump($EQRow);die();
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
                        if($this->dbConnect) {
                            $sqlCheckAlert = "SELECT idalerts, zipcode FROM alerts WHERE typeDescription='".$alert->getTypeDescription()."' AND date='".$alert->getDate()."' AND expires = '".$alert->getExpires()."'";
                            $alertRow = mysqli_query($this->dbConnect, $sqlCheckAlert);
                            if($alertRow->num_rows == 0) {
                                //echo "Alerts not found, insert \n";
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
                                                  '".$this->dbConnect->real_escape_string($alert->getType())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getTypeDescription())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getDescription())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getDate())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getDateEpoch())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getExpires())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getExpiresEpoch())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getMessage())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getPhenomena())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getSignificance())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getZones())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getStormBased())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getWtypeMeteoalarm())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getWtypeMeteoalarmName())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getTitle())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getLevelMeteoalarm())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getLevelMeteoalarmName())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getLevelMeteoalarmDescription())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getFullDescription())."',
                                                  '".$this->dbConnect->real_escape_string($alert->getAttribution())."',
                                                  '".json_encode(array($zipcode))."',
                                                  '".json_encode($alert_json)."')";
                                $alertInsertRow = mysqli_query($this->dbConnect, $sqlInsertAlert);
                            }
                            else {
                                $idalerts = "";
                                $zipcodes = array();
                                while ($row = $alertRow->fetch_assoc()) {
                                    $idalerts = $row['idalerts'];
                                    $zipcodes = json_decode($row['zipcode']);
                                }
                                if(!empty($idalerts)) {
                                    if(!in_array($zipcode,$zipcodes))
                                    {
                                        array_push($zipcodes, $zipcode);
                                    }
                                    $sqlUpdateAlert ="UPDATE alerts 
                                        SET type='".$this->dbConnect->real_escape_string($alert->getType())."',
                                            typeDescription='".$this->dbConnect->real_escape_string($alert->getTypeDescription())."',
                                            description='".$this->dbConnect->real_escape_string($alert->getDescription())."',
                                            date='".$this->dbConnect->real_escape_string($alert->getDate())."',
                                            date_epoch='".$this->dbConnect->real_escape_string($alert->getDateEpoch())."',
                                            expires='".$this->dbConnect->real_escape_string($alert->getExpires())."',
                                            expires_epoch='".$this->dbConnect->real_escape_string($alert->getExpiresEpoch())."',
                                            message='".$this->dbConnect->real_escape_string($alert->getMessage())."',
                                            phenomena='".$this->dbConnect->real_escape_string($alert->getPhenomena())."',
                                            significance='".$this->dbConnect->real_escape_string($alert->getSignificance())."',
                                            zones='".$this->dbConnect->real_escape_string($alert->getZones())."',
                                            storm_based='".$this->dbConnect->real_escape_string($alert->getStormBased())."',
                                            wtype_meteoalarm='".$this->dbConnect->real_escape_string($alert->getWtypeMeteoalarm())."',
                                            wtype_meteoalarm_name='".$this->dbConnect->real_escape_string($alert->getWtypeMeteoalarmName())."',
                                            title='".$this->dbConnect->real_escape_string($alert->getTitle())."',
                                            level_meteoalarm='".$this->dbConnect->real_escape_string($alert->getLevelMeteoalarm())."',
                                            level_meteoalarm_name='".$this->dbConnect->real_escape_string($alert->getLevelMeteoalarmName())."',
                                            level_meteoalarm_description='".$this->dbConnect->real_escape_string($alert->getLevelMeteoalarmDescription())."',
                                            full_description='".$this->dbConnect->real_escape_string($alert->getFullDescription())."',
                                            attribution='".$this->dbConnect->real_escape_string($alert->getAttribution())."',
                                            zipcode='".json_encode($zipcodes)."',
                                            object='".json_encode($alert_json)."'
                                            WHERE idalerts=".$idalerts;
                                    //echo "Alerts found ".$idalerts.", update \n";
                                    $alertUpdateRow = mysqli_query($this->dbConnect, $sqlUpdateAlert);
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

            foreach ($parsed_json->{'DisasterDeclarationsSummaries'} as $disaster_json) {
                $disaster = null;
                $disaster = new FemaDisaster();
                if ($disaster) {
                    $disaster->initFemaDisaster($disaster_json);
                    //if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers))
                    {
                        if ($this->dbConnect) {
                            $sqlCheckDisaster = "SELECT idfema,placeCode FROM fema WHERE disasterNumber='" . $disaster->getDisasterNumber() . "'";
                            $disasterRow = mysqli_query($this->dbConnect, $sqlCheckDisaster);
                            if ($disasterRow->num_rows == 0) {
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
                                                  '" . $this->dbConnect->real_escape_string($disaster->getType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterNumber()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getState()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDeclarationDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getTitle()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentBeginDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentEndDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterCloseOutDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getPlaceCode()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDeclaredCountyArea()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getLastRefresh()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getHash()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getId()) . "',
                                                  '" . json_encode(array($zipcode)) . "',
                                                  '" . json_encode($disaster_json) . "'
                                                  )";
                                //var_dump($sqlInsertDisaster);
                                $disasterInsertRow = mysqli_query($this->dbConnect, $sqlInsertDisaster);
                            } else {
                                $idfema = "";
                                $zipcodes = array();
                                while ($row = $disasterRow->fetch_assoc()) {
                                    $idfema = $row['idfema'];
                                    $zipcodes = json_decode($row['placeCode']);
                                }
                                if(is_array($zipcodes)) {
                                    if (!in_array($zipcode, $zipcodes)) {
                                        array_push($zipcodes, $zipcode);
                                    }
                                    $sqlUpdateDisaster ="UPDATE fema 
                                        SET placeCode = '".$this->dbConnect->real_escape_string($disaster->getPlaceCode())."',
                                            zipcodes ='".json_encode($zipcodes)."',
                                            object = '".json_encode($disaster_json)."'
                                            WHERE idfema=".$idfema;
                                    //echo "DisasterNumber = " . $disaster->getDisasterNumber() . " found DBID = ".$idfema.", update\n";
                                    $disasterUpdateRow = mysqli_query($this->dbConnect, $sqlUpdateDisaster);
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
                    $sqlGetZipsList = "SELECT postal_code FROM zips WHERE state_code='" . $disaster->getState() . "' AND county_name LIKE '".trim(str_replace('(County)','',$disaster->getDeclaredCountyArea()))."%'";
                    $ZipsList = mysqli_query($this->dbConnect, $sqlGetZipsList);
                    if ($ZipsList->num_rows == 0) {
                        while ($row = $ZipsList->fetch_assoc()) {
                            array_push($zipcodes,$row['postal_code']);
                        }
                    }
                    //if($disaster->getState() != $state) continue;
                    //if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers))
                    {
                        if ($this->dbConnect) {
                            $sqlCheckDisaster = "SELECT idfema,placeCode FROM fema WHERE disasterNumber='" . $disaster->getDisasterNumber() . "'";
                            $disasterRow = mysqli_query($this->dbConnect, $sqlCheckDisaster);
                            if ($disasterRow->num_rows == 0) {
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
                                                  '" . $this->dbConnect->real_escape_string($disaster->getType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterNumber()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getState()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDeclarationDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getTitle()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentBeginDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentEndDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterCloseOutDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getPlaceCode()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDeclaredCountyArea()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getLastRefresh()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getHash()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getId()) . "',
                                                  '" . json_encode($zipcodes) . "',
                                                  '" . json_encode($disaster_json) . "'
                                                  )";
                                //var_dump($sqlInsertDisaster);
                                $disasterInsertRow = mysqli_query($this->dbConnect, $sqlInsertDisaster);
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
                                        SET placeCode = '".$this->dbConnect->real_escape_string($disaster->getPlaceCode())."',
                                            zipcodes ='".json_encode($zipcodes)."',
                                            object = '".json_encode($disaster_json)."'
                                            WHERE idfema=".$idfema;
                                    echo "DisasterNumber = " . $disaster->getDisasterNumber() . " found DBID = ".$idfema.", update\n";
                                    $disasterUpdateRow = mysqli_query($this->dbConnect, $sqlUpdateDisaster);
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
                        if ($this->dbConnect) {
                            $sqlCheckDisaster = "SELECT idfema,placeCode FROM fema WHERE disasterNumber='" . $disaster->getDisasterNumber() . "'";
                            $disasterRow = mysqli_query($this->dbConnect, $sqlCheckDisaster);
                            if ($disasterRow->num_rows == 0) {
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
                                                  '" . $this->dbConnect->real_escape_string($disaster->getType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterNumber()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getState()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDeclarationDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getTitle()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentBeginDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentEndDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterCloseOutDate()) . "',
                                                  '" . json_encode(array($zipcode)) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDeclaredCountyArea()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getLastRefresh()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getHash()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getId()) . "')";
                                //var_dump($sqlInsertDisaster);
                                $disasterInsertRow = mysqli_query($this->dbConnect, $sqlInsertDisaster);
                            } else {
                                $idfema = "";
                                $zipcodes = array();
                                while ($row = $disasterRow->fetch_assoc()) {
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
                                    $disasterUpdateRow = mysqli_query($this->dbConnect, $sqlUpdateDisaster);
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
                $sqlCheckDisaster = "SELECT idfema, type, disasterNumber, state, declarationDate, disasterType, incidentType, title, STR_TO_DATE(incidentBeginDate,'%Y-%m-%d') as incidentBeginDate, STR_TO_DATE(incidentEndDate,'%Y-%m-%d') as incidentEndDate, disasterCloseOutDate, placeCode, declaredCountyArea, lastRefresh, hash, id, zipcodes, object 
                                        FROM fema 
                                        WHERE incidentType='" . $type . "' 
                                          AND {$sqlWHERE} 
                                        ORDER BY incidentBeginDate DESC";
            } else {
                $sqlCheckDisaster = "SELECT idfema, type, disasterNumber, state, declarationDate, disasterType, incidentType, title, STR_TO_DATE(incidentBeginDate,'%Y-%m-%d') as incidentBeginDate, STR_TO_DATE(incidentEndDate,'%Y-%m-%d') as incidentEndDate, disasterCloseOutDate, placeCode, declaredCountyArea, lastRefresh, hash, id, zipcodes, object 
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
                        if ($this->dbConnect) {
                            $sqlCheckDisaster = "SELECT idfema,placeCode FROM fema WHERE disasterNumber='" . $disaster->getDisasterNumber() . "'";
                            $disasterRow = mysqli_query($this->dbConnect, $sqlCheckDisaster);
                            if ($disasterRow->num_rows == 0) {
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
                                                  '" . $this->dbConnect->real_escape_string($disaster->getType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterNumber()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getState()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDeclarationDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentType()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getTitle()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentBeginDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getIncidentEndDate()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDisasterCloseOutDate()) . "',
                                                  '" . json_encode(array($zipcode)) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getDeclaredCountyArea()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getLastRefresh()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getHash()) . "',
                                                  '" . $this->dbConnect->real_escape_string($disaster->getId()) . "')";
                                //var_dump($sqlInsertDisaster);
                                $disasterInsertRow = mysqli_query($this->dbConnect, $sqlInsertDisaster);
                            } else {
                                $idfema = "";
                                $zipcodes = array();
                                while ($row = $disasterRow->fetch_assoc()) {
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
                                    $disasterUpdateRow = mysqli_query($this->dbConnect, $sqlUpdateDisaster);
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
                if ($this->dbConnect) {
                    $sqlEQCheck = "SELECT id FROM USGSEarthquake WHERE id='" . $earthquake->getId() . "'";
                    $EQCheckRow = mysqli_query($this->dbConnect, $sqlEQCheck);
                    if ($EQCheckRow->num_rows == 0) {
                        $zipcode = $this->getZipByCoordinate($earthquake->getCoordinates());
                        $zipcodes = array();
                        if (is_array($zipcode)) {
                            if(empty($zipcode['postal_code'])) {
                                if(!empty($zipcode['county'])) {
                                    $sqlGetZips = "SELECT postal_code FROM zips WHERE county_name LIKE '" . $zipcode['county'] . "%'";
                                    $ZipsRow = mysqli_query($this->dbConnect, $sqlGetZips);
                                    if ($ZipsRow->num_rows != 0) {
                                        while ($row = $ZipsRow->fetch_assoc()) {
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
                            $sqlInsertEQ = "INSERT INTO USGSEarthquake(
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
                                  '" . $this->dbConnect->real_escape_string($earthquake->getId()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getTitle()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getType()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getMagType()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getGap()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getRms()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getDmin()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getNst()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getTypes()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getSources()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getIds()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getCode()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getNet()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getSig()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getTsunami()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getStatus()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getAlert()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getMmi()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getCdi()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getFelt()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getDetail()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getUrl()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getTz()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getUpdated()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getTime()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getPlace()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getMag()) . "',
                                  '" . json_encode($earthquake->getCoordinates()) . "',
                                  '" . json_encode($zipcodes) . "',
                                  '" . $zipcode['country'] . "',
                                  '" . $zipcode['address'] . "'                                
                                  )";
                            $EQInsertRow = mysqli_query($this->dbConnect, $sqlInsertEQ);
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
                if ($this->dbConnect) {
                    $sqlEQCheck = "SELECT id FROM USGSEarthquake WHERE id='" . $earthquake->getId() . "'";
                    $EQCheckRow = mysqli_query($this->dbConnect, $sqlEQCheck);
                    if ($EQCheckRow->num_rows == 0) {
                        $zipcode = $this->getZipByCoordinate($earthquake->getCoordinates());
                        $zipcodes = array();
                        if (is_array($zipcode)) {
                            if(empty($zipcode['postal_code'])) {
                                if(!empty($zipcode['county'])) {
                                    $sqlGetZips = "SELECT postal_code FROM zips WHERE county_name LIKE '" . $zipcode['county'] . "%'";
                                    $ZipsRow = mysqli_query($this->dbConnect, $sqlGetZips);
                                    if ($ZipsRow->num_rows != 0) {
                                        while ($row = $ZipsRow->fetch_assoc()) {
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

                            $sqlInsertEQ = "INSERT INTO USGSEarthquake(
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
                                  '" . $this->dbConnect->real_escape_string($earthquake->getId()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getTitle()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getType()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getMagType()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getGap()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getRms()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getDmin()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getNst()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getTypes()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getSources()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getIds()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getCode()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getNet()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getSig()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getTsunami()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getStatus()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getAlert()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getMmi()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getCdi()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getFelt()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getDetail()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getUrl()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getTz()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getUpdated()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getTime()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getPlace()) . "',
                                  '" . $this->dbConnect->real_escape_string($earthquake->getMag()) . "',
                                  '" . json_encode($earthquake->getCoordinates()) . "',
                                  '" . json_encode($zipcodes) . "',
                                  '" . $zipcode['country'] . "',
                                  '" . $zipcode['address'] . "',
                                  '" . json_encode($earthquake_json) . "'                                                                  
                                  )";
                            $EQInsertRow = mysqli_query($this->dbConnect, $sqlInsertEQ);
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
        $json_string = file_get_contents( APISERVER . APIKEY . API_CURRENT_HURRICANE_ENDPOINT . APIFORMAT);

        $parsed_json = json_decode($json_string);

        $return_hurricane = array();

        //Update all records, set to inactive
        if ($this->dbConnect) {
            $sqlUpdate = "UPDATE hurricane SET active_flag = 0";
            $updateRow = mysqli_query($this->dbConnect, $sqlUpdate);
        }

        foreach ($parsed_json->{'currenthurricane'} as $currenthurricane_json) {
            $currenthurricane = new Hurricanes();
            if ($currenthurricane) {
                $currenthurricane->initHurricane($currenthurricane_json);
                echo "============================================\n";
                echo "Number: ".$currenthurricane->getStormNumber()."\n";
                echo "Name: ".$currenthurricane->getStormName()."\n";

                if ($this->dbConnect) {
                    $sqlCheck = "SELECT stormNumber FROM hurricane WHERE stormNumber='" . $currenthurricane->getStormNumber() . "'";
                    $checkRow = mysqli_query($this->dbConnect, $sqlCheck);
                    if ($checkRow->num_rows == 0) {
                        $sqlInsert = "INSERT INTO hurricane (stormNumber, stormName, zipcode, object, active_flag) VALUES (
                                      '".$currenthurricane->getStormNumber()."',
                                      '".$currenthurricane->getStormName()."',
                                      '".json_encode($currenthurricane->getZipcodes())."',
                                      '".json_encode($currenthurricane->getObject())."',
                                      1
                                      )";
                        $insertRow = mysqli_query($this->dbConnect, $sqlInsert);
                        echo "DATA INSERTED\n";
                    } else {
                        $sqlUpdate = "UPDATE hurricane 
                                        SET object = '".json_encode($currenthurricane->getObject())."',
                                            active_flag = 1
                                        WHERE stormNumber = '".$currenthurricane->getStormNumber()."'";
                        $updateRow = mysqli_query($this->dbConnect, $sqlUpdate);
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
        $return_hurricane = array();

        if($this->dbConnect) {
            $sqlSelect = "SELECT * FROM hurricane ORDER BY active_flag, id ASC";
            $selectRow = mysqli_query($this->dbConnect, $sqlSelect);
            if ($selectRow->num_rows != 0) {
                while ($row = $selectRow->fetch_assoc())
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

        foreach ($parsed_json->{'crimes'} as $index => $crime) {
            $crimes = new SpotCrimes();
            if ($crimes) {
                $crimes->initCrimes($crime);
                echo "============================================\n";
                echo "#" . ($index + 1) . " of " . $iCount . "\n";
                echo "ID: " . $crimes->getCdid() . "\n";
                echo "Type: " . $crimes->getType() . "\n";
                if ($this->dbConnect) {
                    $sqlCheck = "SELECT cdid,zipcodes FROM SpotCrimes WHERE cdid='" . $crimes->getCdid() . "'";
                    $checkRow = mysqli_query($this->dbConnect, $sqlCheck);
                    if ($checkRow->num_rows == 0) {
                        echo "CrimeID = " . $crimes->getCdid() . " not found, insert \n";
                        $insertSQL = "INSERT INTO SpotCrimes(cdid, type, date, address, link, lat, lon, zipcodes, object) 
                                      VALUES (
                                      '".$this->dbConnect->real_escape_string($crimes->getCdid())."',
                                      '".$this->dbConnect->real_escape_string($crimes->getType())."',
                                      '".$this->dbConnect->real_escape_string($crimes->getDate())."',
                                      '".$this->dbConnect->real_escape_string($crimes->getAddress())."',
                                      '".$this->dbConnect->real_escape_string($crimes->getLink())."',
                                      '".$this->dbConnect->real_escape_string($crimes->getLat())."',
                                      '".$this->dbConnect->real_escape_string($crimes->getLon())."',
                                      '".json_encode(array($zipcode))."',
                                      '".json_encode($crime)."'
                                      )";
                        $insertRow = mysqli_query($this->dbConnect, $insertSQL);
                    } else {
                        echo "CrimeID = " . $crimes->getCdid() . " found, update \n";
                        $zipcodes = array();
                        while ($row = $checkRow->fetch_assoc()) {
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
                        $updateRow = mysqli_query($this->dbConnect, $updateSQL);
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
                $sqlGetZips = "SELECT postal_code FROM zips WHERE (FIELD11 BETWEEN ({$longitude} - {$radius}/abs(cos(radians({$latitude}))*69)) AND ({$longitude} + {$radius}/abs(cos(radians({$latitude}))*69))) AND (FIELD10 BETWEEN ({$latitude} - ({$radius}/69)) and ({$latitude} + ({$radius}/69)))";
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
        $zipcodes_list = array();
        if($this->dbConnect)
        {
            if($longitude && $latitude) {
                $sqlGetZips = "SELECT postal_code FROM zips WHERE (FIELD11 BETWEEN ({$longitude} - {$radius}/abs(cos(radians({$latitude}))*69)) AND ({$longitude} + {$radius}/abs(cos(radians({$latitude}))*69))) AND (FIELD10 BETWEEN ({$latitude} - ({$radius}/69)) and ({$latitude} + ({$radius}/69)))";
                $zipcodes = mysqli_query($this->dbConnect, $sqlGetZips);
                while ($row = $zipcodes->fetch_assoc()) {
                    array_push($zipcodes_list, $row['postal_code']);
                }
            }

        }
        return $zipcodes_list;
    }
}