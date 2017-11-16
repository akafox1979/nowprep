<?php

class FemaDisaster implements JsonSerializable
{
    private $errorType;
    private $errorDescription;

    private $type;
    private $disasterNumber;
    private $state;
    private $declarationDate;
    private $disasterType;
    private $incidentType;
    private $title;
    private $incidentBeginDate;
    private $incidentEndDate;

    private $disasterCloseOutDate;
    private $placeCode;
    private $declaredCountyArea;
    private $lastRefresh;
    private $hash;
    private $id;

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
            'disasterNumber' => $this->getDisasterNumber(),
            'state' => $this->getState(),
            'declarationDate' => $this->getDeclarationDate(),
            'disasterType' => $this->getDisasterType(),
            'incidentType' => $this->getIncidentType(),
            'title' => $this->getTitle(),
            'incidentBeginDate' => $this->getIncidentBeginDate(),
            'incidentEndDate' => $this->getIncidentEndDate(),
            'disasterCloseOutDate' => $this->getDisasterCloseOutDate(),
            'placeCode' => $this->getPlaceCode(),
            'declaredCountyArea' => $this->getDeclaredCountyArea(),
            'lastRefresh' => $this->getLastRefresh(),
            'hash' => $this->getHash(),
            'id' => $this->getId()
        ];
    }

    public function initFemaDisaster($parsed_json_object)
    {
        //$this->setErrorType($parsed_json_object->{'response'}->{'error'}->{'type'});
        //$this->setErrorDescription($parsed_json_object->{'response'}->{'error'}->{'description'});

        $this->setType( $parsed_json_object->{'disasterType'} );
        $this->setDisasterNumber( $parsed_json_object->{'disasterNumber'} );
        $this->setState( $parsed_json_object->{'state'} );
        $this->setDeclarationDate( $parsed_json_object->{'declarationDate'} );
        $this->setDisasterType( $parsed_json_object->{'disasterType'} );
        $this->setIncidentType( $parsed_json_object->{'incidentType'} );
        $this->setTitle( $parsed_json_object->{'title'} );
        $this->setIncidentBeginDate( $parsed_json_object->{'incidentBeginDate'} );
        if((property_exists($parsed_json_object,'incidentEndDate')))
            $this->setIncidentEndDate( $parsed_json_object->{'incidentEndDate'} );

        if((property_exists($parsed_json_object,'disasterCloseOutDate')))
            $this->setDisasterCloseOutDate( $parsed_json_object->{'disasterCloseOutDate'} );
        $this->setPlaceCode( $parsed_json_object->{'placeCode'} );
        $this->setDeclaredCountyArea( $parsed_json_object->{'declaredCountyArea'} );
        $this->setLastRefresh( $parsed_json_object->{'lastRefresh'} );
        $this->setHash( $parsed_json_object->{'hash'} );
        $this->setId( $parsed_json_object->{'id'} );
        $this->setObject(json_encode($parsed_json_object));
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

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getDisasterNumber()
    {
        return $this->disasterNumber;
    }

    public function setDisasterNumber($disasterNumber)
    {
        $this->disasterNumber = $disasterNumber;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getDeclarationDate()
    {
        return $this->declarationDate;
    }

    public function setDeclarationDate($declarationDate)
    {
        $this->declarationDate = $declarationDate;
    }

    public function getDisasterType()
    {
        return $this->disasterType;
    }

    public function setDisasterType($disasterType)
    {
        $this->disasterType = $disasterType;
    }

    public function getIncidentType()
    {
        return $this->incidentType;
    }

    public function setIncidentType($incidentType)
    {
        $this->incidentType = $incidentType;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getIncidentBeginDate()
    {
        return $this->incidentBeginDate;
    }

    public function setIncidentBeginDate($incidentBeginDate)
    {
        $this->incidentBeginDate = $incidentBeginDate;
    }

    public function getIncidentEndDate()
    {
        return $this->incidentEndDate;
    }

    public function setIncidentEndDate($incidentEndDate)
    {
        $this->incidentEndDate = $incidentEndDate;
    }
    public function getDisasterCloseOutDate()
    {
        return $this->disasterCloseOutDate;
    }

    public function setDisasterCloseOutDate($disasterCloseOutDate)
    {
        $this->disasterCloseOutDate = $disasterCloseOutDate;
    }

    public function getPlaceCode()
    {
        return $this->placeCode;
    }

    public function setPlaceCode($placeCode)
    {
        $this->placeCode = $placeCode;
    }

    public function getDeclaredCountyArea()
    {
        return $this->declaredCountyArea;
    }

    public function setDeclaredCountyArea($declaredCountyArea)
    {
        $this->declaredCountyArea = $declaredCountyArea;
    }

    public function getLastRefresh()
    {
        return $this->lastRefresh;
    }

    public function setLastRefresh($lastRefresh)
    {
        $this->lastRefresh = $lastRefresh;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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

    public function setRowFromDB($row)
    {
        if (is_array($row)) {
            $this->setType( $row['type'] );
            $this->setDisasterNumber( $row['disasterNumber'] );
            $this->setState( $row['state'] );
            $this->setDeclarationDate( $row['declarationDate'] );
            $this->setDisasterType( $row['disasterType'] );
            $this->setIncidentType( $row['incidentType'] );
            $this->setTitle( $row['title'] );
            $this->setIncidentBeginDate( $row['incidentBeginDate'] );
            $this->setIncidentEndDate( $row['incidentEndDate'] );

            $this->setDisasterCloseOutDate( $row['disasterCloseOutDate'] );
            $this->setPlaceCode( $row['placeCode'] );
            $this->setDeclaredCountyArea( $row['declaredCountyArea'] );
            $this->setLastRefresh( $row['lastRefresh'] );
            $this->setHash( $row['hash'] );
            $this->setId( $row['id'] );
            $this->setZipcodes( json_decode($row['zipcodes']));
            $this->setObject($row['object']);
        }
    }
}
