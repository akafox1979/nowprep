<?php

class USGSEarthquake implements JsonSerializable
{
    private $coordinates;
    private $mag;
    private $place;
    private $time;
    private $times;
    private $updated;
    private $tz;
    private $url;
    private $detail;
    private $felt;
    private $cdi;
    private $mmi;
    private $alert;
    private $status;
    private $tsunami;
    private $sig;
    private $net;
    private $code;
    private $ids;
    private $sources;
    private $types;
    private $nst;
    private $dmin;
    private $rms;
    private $gap;
    private $magType;
    private $type;
    private $title;
    private $id;
    private $zipcode;
    private $address;
    private $object;

    public function __construct()
    {
    }

    public function jsonSerialize()
    {
        return [

        ];
    }

    public function getCoordinates()
    {
        return $this->coordinates;
    }

    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
    }

    public function getMag()
    {
        return $this->mag;
    }

    public function setMag($mag)
    {
        $this->mag = $mag;
    }

    public function getPlace()
    {
        return $this->place;
    }

    public function setPlace($place)
    {
        $this->place = $place;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getTimes()
    {
        return $this->times;
    }

    public function setTime($time)
    {
        $this->time = $time/1000;
    }

    public function setTimes($times)
    {
        $this->times = $times;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated/1000;
    }

    public function getTz()
    {
        return $this->tz;
    }

    public function setTz($tz)
    {
        $this->tz = $tz;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getDetail()
    {
        return $this->detail;
    }

    public function setDetail($detail)
    {
        $this->detail = $detail;
    }

    public function getFelt()
    {
        return $this->felt;
    }

    public function setFelt($felt)
    {
        $this->felt = $felt;
    }

    public function getCdi()
    {
        return $this->cdi;
    }

    public function setCdi($cdi)
    {
        $this->cdi = $cdi;
    }

    public function getMmi()
    {
        return $this->mmi;
    }

    public function setMmi($mmi)
    {
        $this->mmi = $mmi;
    }

    public function getAlert()
    {
        return $this->alert;
    }

    public function setAlert($alert)
    {
        $this->alert = $alert;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getTsunami()
    {
        return $this->tsunami;
    }

    public function setTsunami($tsunami)
    {
        $this->tsunami = $tsunami;
    }

    public function getSig()
    {
        return $this->sig;
    }

    public function setSig($sig)
    {
        $this->sig = $sig;
    }

    public function getNet()
    {
        return $this->net;
    }

    public function setNet($net)
    {
        $this->net = $net;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getIds()
    {
        return $this->ids;
    }

    public function setIds($ids)
    {
        $this->ids = $ids;
    }

    public function getSources()
    {
        return $this->sources;
    }

    public function setSources($sources)
    {
        $this->sources = $sources;
    }

    public function getTypes()
    {
        return $this->types;
    }

    public function setTypes($types)
    {
        $this->types = $types;
    }

    public function getNst()
    {
        return $this->nst;
    }

    public function setNst($nst)
    {
        $this->nst = $nst;
    }

    public function getDmin()
    {
        return $this->dmin;
    }

    public function setDmin($dmin)
    {
        $this->dmin = $dmin;
    }

    public function getRms()
    {
        return $this->rms;
    }

    public function setRms($rms)
    {
        $this->rms = $rms;
    }

    public function getGap()
    {
        return $this->gap;
    }

    public function setGap($gap)
    {
        $this->gap = $gap;
    }

    public function getMagType()
    {
        return $this->magType;
    }

    public function setMagType($magType)
    {
        $this->magType = $magType;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object)
    {
        $this->object = $object;
    }

    public function initEarthquake($parsed_json_object)
    {
        $this->setId($parsed_json_object->{'id'});
        $this->setCoordinates($parsed_json_object->{'geometry'}->{'coordinates'});
        $this->setType($parsed_json_object->{'type'});
        $this->setMag($parsed_json_object->{'properties'}->{'mag'});
        $this->setPlace($parsed_json_object->{'properties'}->{'place'});
        $this->setTime($parsed_json_object->{'properties'}->{'time'});
        $this->setUpdated($parsed_json_object->{'properties'}->{'updated'});
        $this->setTz($parsed_json_object->{'properties'}->{'tz'});
        $this->setUrl($parsed_json_object->{'properties'}->{'url'});
        $this->setDetail($parsed_json_object->{'properties'}->{'detail'});
        $this->setFelt($parsed_json_object->{'properties'}->{'felt'});
        $this->setCdi($parsed_json_object->{'properties'}->{'cdi'});
        $this->setMmi($parsed_json_object->{'properties'}->{'mmi'});
        $this->setAlert($parsed_json_object->{'properties'}->{'alert'});
        $this->setStatus($parsed_json_object->{'properties'}->{'status'});
        $this->setTsunami($parsed_json_object->{'properties'}->{'tsunami'});
        $this->setSig($parsed_json_object->{'properties'}->{'sig'});
        $this->setNet($parsed_json_object->{'properties'}->{'net'});
        $this->setCode($parsed_json_object->{'properties'}->{'code'});
        $this->setIds($parsed_json_object->{'properties'}->{'ids'});
        $this->setSources($parsed_json_object->{'properties'}->{'sources'});
        $this->setTypes($parsed_json_object->{'properties'}->{'types'});
        $this->setNst($parsed_json_object->{'properties'}->{'nst'});
        $this->setDmin($parsed_json_object->{'properties'}->{'dmin'});
        $this->setRms($parsed_json_object->{'properties'}->{'rms'});
        $this->setGap($parsed_json_object->{'properties'}->{'gap'});
        $this->setMagType($parsed_json_object->{'properties'}->{'magType'});
        $this->setType($parsed_json_object->{'properties'}->{'type'});
        $this->setTitle($parsed_json_object->{'properties'}->{'title'});
        $this->setObject($parsed_json_object);
    }

    public function setRowFromDB($row)
    {
        if (is_array($row)) {
            $this->setId($row['id']);
            $this->setCoordinates(json_decode($row['coordinates']));
            $this->setType($row['type']);
            $this->setMag($row['mag']);
            $this->setPlace($row['place']);
            $this->setTime($row['time']);
            $this->setTimes($row['times']);
            $this->setUpdated($row['updated']);
            $this->setTz($row['tz']);
            $this->setUrl($row['url']);
            $this->setDetail($row['detail']);
            $this->setFelt($row['felt']);
            $this->setCdi($row['cdi']);
            $this->setMmi($row['mmi']);
            $this->setAlert($row['alert']);
            $this->setStatus($row['status']);
            $this->setTsunami($row['tsunami']);
            $this->setSig($row['sig']);
            $this->setNet($row['net']);
            $this->setCode($row['code']);
            $this->setIds($row['ids']);
            $this->setSources($row['sources']);
            $this->setTypes($row['types']);
            $this->setNst($row['nst']);
            $this->setDmin($row['dmin']);
            $this->setRms($row['rms']);
            $this->setGap($row['gap']);
            $this->setMagType($row['magType']);
            $this->setType($row['type']);
            $this->setTitle($row['title']);
            $this->setZipcode(json_decode($row['zipcode']));
            $this->setAddress($row['address']);
            $this->setObject(json_decode($row['object']));
        }
    }
}