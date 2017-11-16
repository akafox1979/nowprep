<?php

class Alerts implements JsonSerializable
{
    private $errorType;
    private $errorDescription;

    private $type;

    private $typeDescription = array(
        "HUR" => "Hurricane Local Statement",
        "TOR" => "Tornado Warning",
        "TOW" => "Tornado Watch",
        "WRN" => "Severe Thunderstorm Warning",
        "SEW" => "Severe Thunderstorm Watch",
        "WIN" => "Winter Weather Advisory",
        "FLO" => "Flood Warning",
        "WAT" => "Flood Watch / Statement",
        "WND" => "High Wind Advisory",
        "SVR" => "Severe Weather Statement",
        "HEA" => "Heat Advisory",
        "FOG" => "Dense Fog Advisory",
        "SPE" => "Special Weather Statement",
        "FIR" => "Fire Weather Advisory",
        "VOL" => "Volcanic Activity Statement",
        "HWW" => "Hurricane Wind Warning",
        "REC" => "Record Set",
        "REP" => "Public Reports",
        "PUB" => "Public Information Statement"
    );

    private $description;
    private $date;
    private $date_epoch;
    private $expires;
    private $expires_epoch;
    private $message;
    private $phenomena;
    private $significance;
    private $zones;
    private $storm_based;

    private $wtype_meteoalarm;
    private $wtype_meteoalarm_name;
    private $title;
    private $level_meteoalarm;
    private $level_meteoalarm_name;
    private $level_meteoalarm_description;
    private $full_description;

    private $attribution;

    private $zipcodes;
    private $object;

    public function __construct()
    {
    }

    public function jsonSerialize()
    {
        return [
            'errorType' => $this->getErrorType(),
            'errorDescription' => $this->getErrorDescription(),
            'type' => $this->getType(),
            'typeDescription' => $this->getTypeDescription(),
            'description' => $this->getDescription(),
            'date' => $this->getDate(),
            'date_epoch' => $this->getDateEpoch(),
            'expires' => $this->getExpires(),
            'expires_epoch' => $this->getExpiresEpoch(),
            'message' => $this->getMessage(),
            'phenomena' => $this->getPhenomena(),
            'significance' => $this->getSignificance(),
            'zones' => $this->getZones(),
            'storm_based' => $this->getStormBased(),
            'wtype_meteoalarm' => $this->getWtypeMeteoalarm(),
            'wtype_meteoalarm_name' => $this->getWtypeMeteoalarmName(),
            'title' => $this->getTitle(),
            'level_meteoalarm' => $this->getLevelMeteoalarm(),
            'level_meteoalarm_name' => $this->getLevelMeteoalarmName(),
            'level_meteoalarm_description' => $this->getLevelMeteoalarmDescription(),
            'full_description' => $this->getFullDescription(),
            'attribution' => $this->getAttribution()
        ];
    }

    public function getRowForDB()
    {
        return array(
            'type' => $this->getType(),
            'typeDescription' => $this->getTypeDescription(),
            'description' => $this->getDescription(),
            'date' => $this->getDate(),
            'date_epoch' => $this->getDateEpoch(),
            'expires' => $this->getExpires(),
            'expires_epoch' => $this->getExpiresEpoch(),
            'message' => $this->getMessage(),
            'phenomena' => $this->getPhenomena(),
            'significance' => $this->getSignificance(),
            'zones' => $this->getZones(),
            'storm_based' => $this->getStormBased(),
            'wtype_meteoalarm' => $this->getWtypeMeteoalarm(),
            'wtype_meteoalarm_name' => $this->getWtypeMeteoalarmName(),
            'title' => $this->getTitle(),
            'level_meteoalarm' => $this->getLevelMeteoalarm(),
            'level_meteoalarm_name' => $this->getLevelMeteoalarmName(),
            'level_meteoalarm_description' => $this->getLevelMeteoalarmDescription(),
            'full_description' => $this->getFullDescription(),
            'attribution' => $this->getAttribution()
        );
    }

    public function setRowFromDB($row){
        if(is_array($row)){
            $this->setType( $row['type'] );
            $this->setDescription( $row['description'] );
            $this->setDate( $row['date'] );
            $this->setDateEpoch( $row['date_epoch'] );
            $this->setExpires( $row['expires'] );
            $this->setExpiresEpoch( $row['expires_epoch'] );
            $this->setMessage( $row['message'] );
            $this->setPhenomena( $row['phenomena'] );
            $this->setSignificance( $row['significance'] );
            $this->setZipcodes($row['zipcode']);
            $this->setObject(json_decode($row['object']));
        }
    }

    public function setZipcodes($zipcodes)
    {
        $this->zipcodes = json_decode($zipcodes);
    }

    public function getZipcodes()
    {
        return $this->zipcodes;
    }


    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getTypeDescription()
    {
        return (empty($this->type)) ? "" : $this->typeDescription[$this->type];
    }

    public function getErrorType()
    {
        return $this->errorType;
    }

    public function setErrorType($errorType)
    {
        $this->errorType = $errorType;
    }

    public function getErrorDescription()
    {
        return $this->errorDescription;
    }

    public function setErrorDescription($errorDescription)
    {
        $this->errorDescription = $errorDescription;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getMessage($modeSQL = false)
    {
        return ($modeSQL == true) ? mysql_real_escape_string($this->message) : $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getPhenomena()
    {
        return $this->phenomena;
    }

    public function setPhenomena($phenomena)
    {
        $this->phenomena = $phenomena;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getDateEpoch()
    {
        return $this->date_epoch;
    }

    public function setDateEpoch($date_epoch)
    {
        $this->date_epoch = $date_epoch;
    }

    public function getExpires()
    {
        return $this->expires;
    }

    public function setExpires($expires)
    {
        $this->expires = $expires;
    }

    public function getExpiresEpoch()
    {
        return $this->expires_epoch;
    }

    public function setExpiresEpoch($expires_epoch)
    {
        $this->expires_epoch = $expires_epoch;
    }

    public function getSignificance()
    {
        return $this->significance;
    }

    public function setSignificance($significance)
    {
        $this->significance = $significance;
    }

    public function getZones()
    {
        return $this->zones;
    }

    public function setZones($zones)
    {
        $this->zones = $zones;
    }

    public function getStormBased()
    {
        return $this->storm_based;
    }

    public function setStormBased($storm_based)
    {
        $this->storm_based = $storm_based;
    }
    public function getWtypeMeteoalarm()
    {
        return $this->wtype_meteoalarm;
    }

    public function setWtypeMeteoalarm($wtype_meteoalarm)
    {
        $this->wtype_meteoalarm = $wtype_meteoalarm;
    }

    public function getWtypeMeteoalarmName()
    {
        return $this->wtype_meteoalarm_name;
    }

    public function setWtypeMeteoalarmName($wtype_meteoalarm_name)
    {
        $this->wtype_meteoalarm_name = $wtype_meteoalarm_name;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getLevelMeteoalarm()
    {
        return $this->level_meteoalarm;
    }

    public function setLevelMeteoalarm($level_meteoalarm)
    {
        $this->level_meteoalarm = $level_meteoalarm;
    }

    public function getLevelMeteoalarmName()
    {
        return $this->level_meteoalarm_name;
    }

    public function setLevelMeteoalarmName($level_meteoalarm_name)
    {
        $this->level_meteoalarm_name = $level_meteoalarm_name;
    }

    public function getLevelMeteoalarmDescription()
    {
        return $this->level_meteoalarm_description;
    }

    public function setLevelMeteoalarmDescription($level_meteoalarm_description)
    {
        $this->level_meteoalarm_description = $level_meteoalarm_description;
    }

    public function getFullDescription()
    {
        return $this->full_description;
    }

    public function setFullDescription($full_description)
    {
        $this->full_description = $full_description;
    }

    public function getAttribution()
    {
        return $this->attribution;
    }

    public function setAttribution($attribution)
    {
        $this->attribution = $attribution;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object)
    {
        $this->object = $object;
    }

    public function initAlerts($parsed_json_object)
    {
        $this->setErrorType($parsed_json_object->{'response'}->{'error'}->{'type'});
        $this->setErrorDescription($parsed_json_object->{'response'}->{'error'}->{'description'});

        $this->setType( $parsed_json_object->{'type'} );
        $this->setDescription( $parsed_json_object->{'description'} );
        $this->setDate( $parsed_json_object->{'date'} );
        $this->setDateEpoch( $parsed_json_object->{'date_epoch'} );
        $this->setExpires( $parsed_json_object->{'expires'} );
        $this->setExpiresEpoch( $parsed_json_object->{'expires_epoch'} );
        $this->setMessage( $parsed_json_object->{'message'} );
        $this->setPhenomena( $parsed_json_object->{'phenomena'} );
        $this->setSignificance( $parsed_json_object->{'significance'} );
        $this->setObject($parsed_json_object);
    }
}
