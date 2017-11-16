<?php

class SpotCrimes implements JsonSerializable {

    private $cdid;
    private $type;
    private $date;
    private $address;
    private $link;
    private $lat;
    private $lon;
    private $zipcodes;
    private $object;

    public function getCdid()
    {
        return $this->cdid;
    }

    public function setCdid($cdid)
    {
        $this->cdid = $cdid;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    public function getLon()
    {
        return $this->lon;
    }

    public function setLon($lon)
    {
        $this->lon = $lon;
    }

    public function getZipcodes()
    {
        return $this->zipcodes;
    }

    public function setZipcodes($zipcodes)
    {
        $this->zipcodes = $zipcodes;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object)
    {
        $this->object = $object;
    }

    public function __construct()
    {
    }

    public function jsonSerialize()
    {
    }

    public function getRowForDB()
    {
        return array(
        );
    }

    public function setRowFromDB($row){
        if(is_array($row)){
            $this->setCdid($row['cdid']);
            $this->setType($row['type']);
            $this->setDate($row['date']);
            $this->setAddress($row['address']);
            $this->setLink($row['link']);
            $this->setLat($row['lat']);
            $this->setLon($row['lon']);
            $this->setZipcodes(json_decode($row['zipcodes']));
            $this->setObject(json_decode($row['object']));
        }
    }

    public function initCrimes($parsed_json_object)
    {
        $this->setCdid($parsed_json_object->{'cdid'});
        $this->setType($parsed_json_object->{'type'});
        $this->setDate($parsed_json_object->{'date'});
        $this->setAddress($parsed_json_object->{'address'});
        $this->setLink($parsed_json_object->{'link'});
        $this->setLat($parsed_json_object->{'lat'});
        $this->setLon($parsed_json_object->{'lon'});
        $this->setObject(json_encode($parsed_json_object));
    }
}